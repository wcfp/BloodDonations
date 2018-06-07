require('./bootstrap');

import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import router from './router'
import store from './store'

require('./components');
require('./errorHandling');

Vue.use(VueMaterial);

const app = new Vue({
    el: '#app',
    store,
    router,
    template: '<app/>'
});
