require('./bootstrap');
window.Vue = require('vue');
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import vuetify from './plugins/vuetify';
import './sass/main.scss';
import VuePapaParse from 'vue-papa-parse';
//import {fetch as fetchPolyfill} from 'whatwg-fetch'
import 'whatwg-fetch';

//import VueBlobJsonCsv from 'vue-blob-json-csv';




Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VuePapaParse);

//Vue.use(VueBlobJsonCsv);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
const app = new Vue({
    el: '#app',
    vuetify,
    router: router,

    render: h => h(App),
});

