require('./bootstrap');

import Vue from 'vue'
import router from './router'
import store from './store'

require('./components');


const app = new Vue({
    el: '#app',
    store,
    router,
    template: '<app/>'
});
