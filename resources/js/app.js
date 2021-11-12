// require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios').default;

import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1/';

import App from './vue/App.vue';
import VueRouter from 'vue-router';
import routes from './router/router'
import Vue from 'vue';
Vue.use(VueRouter);

import notifications from "vt-notifications";
Vue.use(notifications);

const router = new VueRouter({
    mode: 'history',
    routes,
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    axios,
    notifications
});