<template>

    <div>
        <h4 class="text-info text-center p-4 h-100">
            Update existing stock
        </h4>
        <div class="container">
            <div class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <span class="form-control mt-1 mb-1 bg-info text0-light">
                        {{ stock.company }}
                    </span>
                    <span v-if="errors.unit_price" class="small text-danger"> {{ errors.unit_price }} </span>
                    <div class="d-flex bg-secondary font-weight-bold text-light align-items-center form-control pr-0 mb-2">
                        &euro;
                        <input
                            type="number"
                            class="form-control mt-1 mb-1 ml-3"
                            placeholder="Unit price"
                            v-model="stock.unit_price"
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
    name: 'UpdateStock',
    data(){
        return{
            stock: {},
            errors: {
                unit_price: ''
            },
        }
    },
    mounted(){
        const stock_id = this.$route.params.stock_id;
        axios.get(`/api/get_single_stock/${stock_id}`)
        .then( res =>  {
            if(res.data.stock.length){
                this.stock = res.data.stock[0]
            }
            else{
                this.$router.push({ path: '/404' })
            }
        })
        .catch( err => console.log(err))
    },
    methods:{
        SaveStock(){
            const data = JSON.stringify(this.stock)
            axios.post(`/api/update_stock/${data}`)
            .then( res =>  {
                if(res.data.hasOwnProperty('errors')){
                    this.errors.unit_price = res.data.errors.unit_price ? res.data.errors.unit_price[0] : ''
                }
                else{
                    this.errors.unit_price = ''
                    this.$swal({
                        title: 'Done',
                        text: "Stock has been updated",
                        icon: 'success',
                    });
                    this.stock.unit_price = res.data.updated_stock.unit_price
                }
            })
            .catch( err => console.log(err))
        },
    }
}
</script>
