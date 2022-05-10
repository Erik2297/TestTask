require('./bootstrap');
window.Vue = require('vue').default;

// EXTRA
import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Vuex from 'vuex'
import store from './store'
import 'bootstrap'

axios.defaults.headers.common['content-type'] = 'application/json;charset=UTF-8'
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Vuex);

// MAIN COMPONENT
import App from './components/App.vue'

// COMPONENTS
import Home from './components/main/Home.vue'
import Stocks from './components/main/Stocks.vue'
import Clients from './components/main/Clients.vue'

// Error components
import NotFound from './components/error/NotFound.vue'


// ROUTES
const routes = [
    // MAIN ROUTES
    { path: '/', component: Home },
    { path: '/stocks', component: Stocks },
    { path: '/clients', component: Clients },

    // IF ROUTE DOES NOT EXISTS
    { path: '/404', component: NotFound },
    { path: '*', redirect: '/404' },
]

const router = new VueRouter({
    mode: 'history',
    base: '/',
    fallback: true,
    routes
})
router.mode = 'html5'

// MOUNT OF App.vue FILE
const app = new Vue({
    el: '#app',
  	router,
    store,
    render: h => h(App),
});
