import Vue from 'vue'
import Vuex from 'vuex'
import userModule from './userStore'
import linksStore from "./linksStore";
import donationStore from "./donationStore";
import donorStore from "./donorStore";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user: userModule,
        links: linksStore,
        donation: donationStore,
        donor: donorStore
    }
});

