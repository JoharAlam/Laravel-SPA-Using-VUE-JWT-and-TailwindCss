import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';
import routes from './router';
require("bootstrap-css-only/css/bootstrap.min.css");
require("mdbvue/lib/css/mdb.min.css");
require("@fortawesome/fontawesome-free/css/all.min.css");
// import 'vuejs-datatable/dist/themes/bootstrap-4.esm.js';
// import { VuejsDatatableFactory } from 'vuejs-datatable';


require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueAxios, axios);
Vue.use(VueRouter);
// Vue.use( VuejsDatatableFactory );

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
