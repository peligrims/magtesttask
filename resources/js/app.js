import Vuetify from "vuetify";

require('./bootstrap');
window.Vue = require('vue');
import App from './App.vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import './sass/main.scss';
import 'whatwg-fetch';
import store from './store';
import vuetify from './plugins/vuetify';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
const app = new Vue({
    el: '#app',
    vuetify,
    store,
    router: router,
    render: h => h(App),
});

