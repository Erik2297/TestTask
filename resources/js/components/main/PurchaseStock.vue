<template>

    <div>
        <h4 class="text-info text-center p-4 h-100">
            Purchase a stock
        </h4>
        <div class="container">
            <div class="card mx-auto" style="width: 26rem;">
                <div class="card-body">
                    <div class="form-group">
                        <span class="small text-danger" v-if="errors.client_id"> {{ errors.client_id }} </span>
                        <select class="form-control" v-model='purchase_data.client_id'>
                            <option value="null">Choose client</option>
                            <option v-for="client in clients" :key='client.id' :value="client.id">
                                {{ client.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="small text-danger" v-if="errors.stock_id"> {{ errors.stock_id }} </span>
                        <select class="form-control" v-model="purchase_data.stock_id">
                            <option value="null" selected>Choose stock</option>
                            <option v-for="stock in stocks" :key='stock.id' :value="stock.id">
                                {{ stock.company }} / Unit price <b>&euro;</b> {{ stock.unit_price }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="small text-danger" v-if="errors.volume"> {{ errors.volume }} </span>
                        <input type="number" class="form-control" placeholder="Volume" v-model="purchase_data.volume">
                    </div>
                    <span class="small text-danger" v-if="errors.not_enough"> {{ errors.not_enough }} </span>
                    <button
                        class="btn btn-info float-right"
                        @click="SavePurchase"
                        :disabled="purchase_data.client_id == null || purchase_data.stock_id == null || purchase_data.volume == null"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: 'PurchaseStock',
    data(){
        return{
            clients: [],
            stocks: [],
            purchase_data: {
                client_id: null,
                stock_id: null,
                volume: null,
            },
            errors: {
                client_id: '',
                stock_id: '',
                volume: '',
                not_enough: '',
            },
            stocks_select_status : true,
        }
    },
    mounted(){
        axios.get(`/api/purchase_stocks_clients`)
        .then( res =>  {
            this.clients = res.data.clients
            this.stocks = res.data.stocks
        })
        .catch( err => console.log(err))
    },
    methods:{
        SavePurchase(){
            const data = JSON.stringify(this.purchase_data)
            axios.post(`/api/purchase_stock/${data}`)
            .then( res =>  {
                if(res.data.hasOwnProperty('errors')){
                    if(res.data.errors.hasOwnProperty('not_enough')){
                        this.errors.not_enough = res.data.errors.not_enough
                    }
                    else{
                        this.errors.client_id = res.data.errors.client_id ? res.data.errors.client_id[0] : ''
                        this.errors.stock_id = res.data.errors.stock_id ? res.data.errors.stock_id[0] : ''
                        this.errors.volume = res.data.errors.volume ? res.data.errors.volume[0] : ''
                    }
                }
                else{
                    this.errors.client_id = ''
                    this.errors.stock_id = ''
                    this.errors.volume = ''
                    this.errors.not_enough = ''
                    this.purchase_data.client_id = null
                    this.purchase_data.stock_id = null
                    this.purchase_data.volume = null
                    this.$swal({
                        title: 'Done',
                        text: "Purchase has been done",
                        icon: 'success',
                    });
                }
            })
            .catch( err => console.log(err))
        }
    }
}
</script>
