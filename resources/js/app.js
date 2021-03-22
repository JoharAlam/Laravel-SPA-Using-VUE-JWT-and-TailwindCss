import VueAxios from 'vue-axios';
import axios from 'axios';
import VueRouter from 'vue-router';
import routes from './router';

require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueAxios, axios);
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
