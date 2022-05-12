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
                        <th scope="col">Gain/Loss</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients" :key="client.id">
                        <th scope="row">{{ client.name }}</th>
                        <td>&euro; {{ client.cash }}</td>
                        <td> Gain/Loss </td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="w-100 p-4">
                <p v-if="!addNewClientForm" class="float-right">
                    <span class="pr-2"> Add a new Client </span>
                    <i class="fa-solid fa-square-plus text-secondary fa-2xl" title="Add a new Client" @click="addNewClientFormOpen"></i>
                </p>
                <p v-else class="float-right">
                    <span class="pr-2"> Cancel </span>
                    <i class="fa-solid fa-square-xmark text-secondary fa-2xl" title="Cancel" @click="cancelNewClientFormOpen"></i>
                </p>
            </div>
            <hr>
            <div v-if="addNewClientForm" class="card" style="width: 18rem;">
                <div class="card-body">
                    <p>Create a new Client</p>
                    <div class="d-flex bg-secondary font-weight-bold text-light align-items-center form-control pr-0 mb-2">
                        @
                        <input
                            type="text"
                            class="form-control mt-1 mb-1 ml-3"
                            placeholder="Username"
                            v-model="newClient.username"
                        />
                    </div>
                    <button class="btn btn-info btn-sm float-right">Save</button>
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
            loading: true,
            clients: [],
            addNewClientForm: false,
            newClient: {
                username: '',
            }
        }
    },
    mounted(){
        axios.get(`/api/get_clients`)
        .then( res =>  {
            this.clients = res.data.clients
        })
        .catch( err =>
            console.log(err)
        )
        .finally(() => (
            this.loading = false
        ));
    },
    methods:{
        addNewClientFormOpen(){
            this.addNewClientForm = true
        },
        cancelNewClientFormOpen(){
            this.newClient.username = ''
            this.addNewClientForm = false
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
