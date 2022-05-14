<template>

    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Test Task</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center w-100" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link :class="'nav-item nav-link '+(this.$router.name == '/' ? ' active' : '')" to="/">Home</router-link>
                    <router-link :class="'nav-item nav-link '+(this.$router.name == '/stocks' ? ' active' : '')" to="/stocks">Stocks</router-link>
                    <router-link :class="'nav-item nav-link '+(this.$router.name == '/clients' ? ' active' : '')" to="/clients">Clients</router-link>
                    <router-link :class="'nav-item nav-link '+(this.$router.name == '/purchase_stock' ? ' active' : '')" to="/purchase_stock">Purchase a Stock</router-link>
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

<style scoped>
    .router-link-exact-active {
        font-weight: bold !important;
        color: #17A2B8 !important;
    }
    .nav-item{
        text-decoration: none;
        color: white;
    }
</style>
