import Vue from 'vue'
import Vuex from 'vuex'
import userModule from './userStore'
import linksStore from "./linksStore";
import donorStore from "./donationStore";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user: userModule,
        links: linksStore, donorStore



    }
});

