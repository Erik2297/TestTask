<template>

    <div>
        <h4 class="text-info text-center p-4 h-100">
            List all clients
        </h4>
        <div class="container">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Cash Balance</th>
                        <th scope="col">
                            Gain/Loss
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
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients" :key="client.id">
                        <th scope="row">{{ client.name }}</th>
                        <td> <b>&euro;</b> {{ client.cash.toFixed(2) }}</td>
                        <td :class="'text-'+(client.gainorloss > 0 ? 'success' : client.gainorloss == 0 ? 'dark' : 'danger')">
                            <b>
                                {{ client.gainorloss > 0 ? ' + ' : client.gainorloss == 0 ? '' : ' - ' }}
                                &euro; {{ Math.abs(client.gainorloss).toFixed(2) }}
                            </b>
                        </td>
                        <td>
                            <div>
                                <i
                                    class="fa-solid fa-gear text-primary fa-xl "
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                ></i>
                                <div class="dropdown-menu mt-3">
                                    <router-link :to="'/view_stocks/'+client.id" class="dropdown-item" role="button">
                                        View stocks
                                    </router-link>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="w-100 p-4">
                <p v-if="!addNewClientForm" class="float-right">
                    <span class="pr-2"> Create a new Client </span>
                    <i class="fa-solid fa-square-plus text-secondary fa-2xl" title="Create a new Client" @click="addNewClientFormOpen"></i>
                </p>
                <p v-else class="float-right">
                    <span class="pr-2"> Cancel </span>
                    <i class="fa-solid fa-square-xmark text-secondary fa-2xl" title="Cancel" @click="cancelNewClientFormOpen"></i>
                </p>
            </div>
            <div v-if="addNewClientForm" class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <p>Create a new Client</p>
                    <span v-if="errors.username" class="small text-danger"> {{ errors.username }} </span>
                    <div class="d-flex bg-secondary font-weight-bold text-light align-items-center form-control pr-0 mb-2">
                        @
                        <input
                            type="text"
                            class="form-control mt-1 mb-1 ml-3"
                            placeholder="Username"
                            v-model="newClient.username"
                        />
                    </div>
                    <button class="btn btn-info btn-sm float-right" @click="SaveClient">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'Clients',
    data(){
        return{
            clients: [],
            addNewClientForm: false,
            newClient: {
                username: '',
            },
            errors: {
                username: ''
            },
            sort_type: 'descending'
        }
    },
    mounted(){
        axios.get(`/api/get_clients`)
        .then( res =>  {
            res.data.clients.map(client => {
                let sum = 0
                client.stocks.map(stock => {
                    sum += (stock.stock.unit_price - stock.purchase_price) * stock.volume
                })
                client.gainorloss = sum
            })
            this.clients = res.data.clients.sort((a,b) => b.gainorloss - a.gainorloss)
        })
        .catch( err => console.log(err))
    },
    methods:{
        addNewClientFormOpen(){
            this.addNewClientForm = true
        },
        cancelNewClientFormOpen(){
            this.newClient.username = ''
            this.addNewClientForm = false
        },
        SaveClient(){
            const data = JSON.stringify(this.newClient)
            axios.post(`/api/new_client/${data}`)
            .then( res =>  {
                if(res.data.hasOwnProperty('errors')){
                    this.errors.username = res.data.errors.username[0]
                }
                else{
                    this.errors.username = ''
                    this.$swal({
                        title: 'Done',
                        text: "Client has been added",
                        icon: 'success',
                    });
                    let sum = 0
                    res.data.new_client.stocks.map(stock => {
                        sum += (stock.stock.unit_price - stock.purchase_price) * stock.volume
                    })
                    res.data.new_client.gainorloss = sum
                    this.clients.push( res.data.new_client )
                    this.cancelNewClientFormOpen()
                }
            })
            .catch( err => console.log(err))
        },
        SortTrigger(){
            if (this.sort_type == "descending") {
                this.sort_type = "ascending"
                this.clients = this.clients.sort((a,b) => a.gainorloss - b.gainorloss)
            }
            else{
                this.sort_type = "descending";
                this.clients = this.clients.sort((a,b) => b.gainorloss - a.gainorloss)
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
    .sort-arrows{
        cursor: pointer;
        transition: 0.2s;
    }
</style>
