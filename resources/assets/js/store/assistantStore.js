export default {
    state: {
        assistantRequests: [],
        assistantDonations: [],
        donors: [],
    },
    mutations: {
        storeAssistantRequests(state, newRequest) {
            state.assistantRequests = newRequest
        },
        storeDonations(state, newRequest) {
            state.assistantDonations = newRequest
        },
        storeDonors(state, newDonors) {
            state.donors = newDonors
        }
    },
    getters: {
        assistantRequests: (state) => state.assistantRequests,
        assistantDonations: (state) => state.assistantDonations,
        donors: (state) => state.donors,

    },
    actions: {
        getAssistantRequests(context) {
            return axios.get('/api/blood/requests')
                .then(response => context.commit('storeAssistantRequests', response.data))
        },
        getDonations(context) {
            return axios.get('/api/assistant/donations')
                .then(response => context.commit('storeDonations', response.data))
        },

        getDonors(context) {
            return axios.get('/api/assistant/donors')
                .then(response => context.commit('storeDonors', response.data))
        }
    }
}