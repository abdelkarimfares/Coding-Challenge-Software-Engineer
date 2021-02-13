/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

window.API_URL = 'http://127.0.0.1:8000/api';

//VueRouter
import VueRouter from 'vue-router';

import routes from "@/routes/routes";

const router = new VueRouter({
  routes,
  linkExactActiveClass: "nav-item active",
  mode: 'history'
});

Vue.use(VueRouter);
window.routes = routes;

import App from '@/pages/App.vue';

//Store
import store from '@/store/index.js';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    render: h => h(App),
    store,
    router,
});
