<template>

    <div>
        <h4 class="text-info text-center p-4 h-100">
            List all stocks
        </h4>
        <div class="container">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">
                            Unit price
                            <i
                                @click="SortTrigger"
                                v-if="sort_type == 'descending'"
                                class="sort-arrows fas fa-arrow-alt-circle-down text-success">
                            </i>
                            <i
                                @click="SortTrigger"
                                v-else-if="sort_type == 'ascending'"
                                class="sort-arrows fas fa-arrow-alt-circle-up text-danger">
                            </i>
                        </th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stock in stocks" :key="stock.id">
                        <th scope="row">{{ stock.company }}</th>
                        <td> <b>&euro;</b> {{ stock.unit_price.toFixed(2) }}</td>
                        <td>{{ formatDate(new Date(stock.updated_at ? stock.updated_at : stock.created_at )) }}</td>
                        <td>
                            <div>
                                <i
                                    class="fa-solid fa-gear text-primary fa-xl "
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                ></i>
                                <div class="dropdown-menu mt-3">
                                    <router-link :to="'/update_stock/'+stock.id" class="dropdown-item" role="button">
                                        Update unit price
                                    </router-link>
                                    <a class="dropdown-item" role="button" @click="DeleteStock(stock.id)">
                                        Delete stock
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="w-100 p-4">
                <p v-if="!addNewStockForm" class="float-right">
                    <span class="pr-2"> Create a new Stock </span>
                    <i class="fa-solid fa-square-plus text-secondary fa-2xl" title="Create a new Stock" @click="addNewStockFormOpen"></i>
                </p>
                <p v-else class="float-right">
                    <span class="pr-2"> Cancel </span>
                    <i class="fa-solid fa-square-xmark text-secondary fa-2xl" title="Cancel" @click="cancelNewStockFormOpen"></i>
                </p>
            </div>
            <div v-if="addNewStockForm" class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <p>Create a new stock</p>
                    <span v-if="errors.company" class="small text-danger"> {{ errors.company }} </span>
                    <input
                        type="text"
                        class="form-control mt-1 mb-1"
                        placeholder="Company name"
                        v-model="newStock.company"
                    />
                    <span v-if="errors.unit_price" class="small text-danger"> {{ errors.unit_price }} </span>
                    <div class="d-flex bg-secondary font-weight-bold text-light align-items-center form-control pr-0 mb-2">
                        &euro;
                        <input
                            type="number"
                            class="form-control mt-1 mb-1 ml-3"
                            placeholder="Unit price"
                            v-model="newStock.unit_price"
                        />
                    </div>
                    <button class="btn btn-info btn-sm float-right" @click="SaveStock">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'Stocks',
    data(){
        return{
            stocks: [],
            addNewStockForm: false,
            newStock: {
                company: '',
                unit_price: ''
            },
            errors: {
                company: '',
                unit_price: ''
            },
            sort_type: 'descending'
        }
    },
    mounted(){
        axios.get(`/api/get_stocks`)
        .then( res =>  {
            this.stocks = res.data.stocks.sort((a,b) => b.unit_price - a.unit_price)
        })
        .catch( err => console.log(err))
    },
    methods:{
        padTo2Digits(num) {
           return num.toString().padStart(2, '0');
        },
        formatDate(date) {
            return [
                this.padTo2Digits(date.getDate()),
                this.padTo2Digits(date.getMonth() + 1),
                date.getFullYear(),
            ].join('/');
        },
        addNewStockFormOpen(){
            this.addNewStockForm = true
        },
        cancelNewStockFormOpen(){
            this.newStock.company = ''
            this.newStock.unit_price = ''
            this.addNewStockForm = false
        },
        SaveStock(){
            const data = JSON.stringify(this.newStock)
            axios.post(`/api/new_stock/${data}`)
            .then( res =>  {
                if(res.data.hasOwnProperty('errors')){
                    this.errors.company = res.data.errors.company ? res.data.errors.company[0] : ''
                    this.errors.unit_price = res.data.errors.unit_price ? res.data.errors.unit_price[0] : ''
                }
                else{
                    this.errors.company = ''
                    this.errors.unit_price = ''
                    this.$swal({
                        title: 'Done',
                        text: "Stock has been added",
                        icon: 'success',
                    });
                    this.stocks.push( res.data.new_stock )
                    this.cancelNewStockFormOpen()
                }
            })
            .catch( err => console.log(err))
        },
        DeleteStock(stock_id){
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`/api/delete_stock/${stock_id}`)
                    .then( res =>  {
                        if(res.data['request-status'] != 'error'){
                            this.$swal({
                                title: 'Done',
                                text: "Stock has been deleted",
                                icon: 'success',
                            });
                            this.stocks.splice(this.stocks.indexOf(this.stocks.find(stock => stock.id == stock_id)),1)
                        }
                        else{
                            this.$swal({
                                title: 'Oops',
                                text: "Something went wrong, please refresh the page and try again",
                                icon: 'danger',
                            });
                        }
                    })
                    .catch( err => console.log(err))
                }
            })
        },
        SortTrigger(){
            if (this.sort_type == "descending") {
                this.sort_type = "ascending"
                this.stocks = this.stocks.sort((a,b) => a.unit_price - b.unit_price)
            }
            else{
                this.sort_type = "descending";
                this.stocks = this.stocks.sort((a,b) => b.unit_price - a.unit_price)
            }
        }
    }
}

</script>

<style scoped>
    .fa-square-plus, .fa-square-xmark{
        transition: 0.1s;
    }
    .fa-square-plus:hover{
        color: #17A2B8 !important;
        cursor: pointer;
    }
    .fa-square-xmark:hover{
        color: #DC3545 !important;
        cursor: pointer;
    }
</style>
