import Vue from 'vue'
import Vuex from 'vuex'
import userModule from './userStore'
import linksStore from "./linksStore";
import donationStore from "./donationStore";
import donorStore from "./donorStore";
import doctorStore from "./doctorStore";
import bloodContainerStore from "./bloodContainerStore";
import errorStore from "./errorStore";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user: userModule,
        links: linksStore,
        donation: donationStore,
        bloodContainer: bloodContainerStore,
        donor: donorStore,
        doctor: doctorStore,
        errors: errorStore,
    }
});

