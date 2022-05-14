<template>

    <div>
        <h4 class="text-info text-center p-4 h-100">
            List client's stocks <span class="small">{{ client.name }}</span>
        </h4>
        <div class="container">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Volume</th>
                        <th scope="col">Purchase price</th>
                        <th scope="col">Current price</th>
                        <th scope="col">Gain/Loss</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stock in stocks" :key="stock.id">
                        <th scope="row">{{ stock.stock.company }}</th>
                        <td> {{ stock.volume }}</td>
                        <td> <b>&euro;</b> {{ stock.purchase_price.toFixed(2) }}</td>
                        <td> <b>&euro;</b> {{ stock.stock.unit_price.toFixed(2) }}</td>
                        <td :class="'text-'+(stock.gainorloss > 0 ? 'success' : stock.gainorloss == 0 ? 'dark' : 'danger')">
                            <b>
                                {{ stock.gainorloss > 0 ? ' + ' : stock.gainorloss == 0 ? '' : ' - ' }}
                                &euro; {{ Math.abs(stock.gainorloss).toFixed(2) }}
                            </b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="d-flex justify-content-end">
                <div class="card w-25">
                    <div class="card-body w-100 d-flex">
                        <div class="w-50 pr-4">
                            <p class="text-right"> Total </p>
                            <p class="text-right"> Invested </p>
                            <p class="text-right"> Performance </p>
                            <p class="text-right"> Cash Balance </p>
                        </div>
                        <div class="w-50">
                            <p :class="'text-right text-'+(info.total > 0 ? 'success' : info.total == 0 ? 'dark' : 'danger')">
                                {{ info.total > 0 ? ' + ' : info.total == 0 ? '' : ' - ' }}
                                &euro; {{ Math.abs(info.total).toFixed(2) }}
                            </p>
                            <p class="text-right text-dark">
                                &euro; {{ Math.abs(info.invested).toFixed(2) }}
                            </p>
                            <p :class="'text-right text-'+(info.performance > 0 ? 'success' : info.performance == 0 ? 'dark' : 'danger')">
                                {{ info.performance > 0 ? ' + ' : info.performance == 0 ? '' : ' - ' }}
                                &euro; {{ Math.abs(info.performance).toFixed(2) }}
                            </p>
                            <p class="text-right text-dark">
                                &euro; {{ Math.abs(info.cashbalance).toFixed(2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'ViewStocks',
    data(){
        return{
            stocks: [],
            client: {},
            info:{
                total: 0,
                invested: 0,
                performance: 0,
                cashbalance: 0,
            }
        }
    },
    mounted(){
        axios.get(`/api/get_clients_stocks/${this.$route.params.client_id}`)
        .then( res =>  {
            if(res.data.hasOwnProperty('no_user')){
                this.$router.push({ path: '/404' })
            }
            else{
                if(res.data.stocks.length){
                    res.data.stocks.map(item => {
                        item.gainorloss = (item.stock.unit_price - item.purchase_price) * item.volume
                        this.info.total += +item.gainorloss
                        this.info.invested += +item.purchase_price
                    })
                    this.info.performance = (this.info.total / this.info.invested) * 100
                    this.stocks = res.data.stocks
                    this.client = res.data.client
                    this.info.cashbalance += this.client.cash
                }
            }
        })
        .catch( err => console.log(err))
    }
}

</script>
