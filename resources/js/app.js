import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';
import routes from './router';
import DataTable from "@andresouzaabreu/vue-data-table";

require("mdbvue/lib/css/mdb.min.css");
require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Vue.component("data-table", DataTable);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
