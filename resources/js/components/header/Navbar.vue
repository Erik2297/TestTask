<template>

    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Test Task</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center w-100" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link active" to="/">Home</router-link>
                    <router-link class="nav-item nav-link" to="/stocks">Stocks</router-link>
                    <router-link class="nav-item nav-link" to="/clients">Clients</router-link>
                </div>
            </div>
        </nav>
    </div>

</template>

<script>
export default {
    name: "Navbar",
    data(){
        return{

        }
    }
}
</script>
