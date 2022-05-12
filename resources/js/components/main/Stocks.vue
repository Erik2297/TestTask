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
                        <th scope="col">Unit price</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stock in stocks" :key="stock.id">
                        <th scope="row">{{ stock.company }}</th>
                        <td>&euro; {{ stock.unit_price }}</td>
                        <td>{{ formatDate(new Date(stock.created_at)) }}</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="w-100 p-4">
                <p v-if="!addNewStockForm" class="float-right">
                    <span class="pr-2"> Add a new Stock </span>
                    <i class="fa-solid fa-square-plus text-secondary fa-2xl" title="Add a new Stock" @click="addNewStockFormOpen"></i>
                </p>
                <p v-else class="float-right">
                    <span class="pr-2"> Cancel </span>
                    <i class="fa-solid fa-square-xmark text-secondary fa-2xl" title="Cancel" @click="cancelNewStockFormOpen"></i>
                </p>
            </div>
            <hr>
            <div v-if="addNewStockForm" class="card" style="width: 18rem;">
                <div class="card-body">
                    <p>Create a new stock</p>
                    <input
                        type="text"
                        class="form-control mt-1 mb-1"
                        placeholder="Company name"
                        v-model="newStock.company"
                    />
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
            loading: true,
            stocks: [],
            addNewStockForm: false,
            newStock: {
                company: '',
                unit_price: ''
            }
        }
    },
    mounted(){
        axios.get(`/api/get_stocks`)
        .then( res =>  {
            this.stocks = res.data.stocks
        })
        .catch( err =>
            console.log(err)
        )
        .finally(() => (
            this.loading = false
        ));
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
            axios.get(`/api/get_stocks`)
            .then( res =>  {
                this.stocks = res.data.stocks
            })
            .catch( err =>
                console.log(err)
            )
            .finally(() => (
                this.loading = false
            ));
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
