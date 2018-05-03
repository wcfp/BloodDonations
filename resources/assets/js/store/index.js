import Vue from 'vue'
import Vuex from 'vuex'
import userModule from './userStore'
import linksStore from "./linksStore";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user: userModule,
        links: linksStore
    }
});

