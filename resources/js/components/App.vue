<template>

    <div>
        <Navbar/>
        <router-view></router-view>
    </div>

</template>

<script>
import Navbar from './header/Navbar.vue';
export default {
    name: 'App',
    components:{
        Navbar,
    }
}
</script>

<style scoped>
    @import '~bootstrap/dist/css/bootstrap.css';
</style>
