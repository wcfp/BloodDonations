export default {
    state: {
        assistantRequests: [],
        assistantDonations: [],
    },
    mutations: {
        storeAssistantRequests(state, newRequest) {
            state.assistantRequests = newRequest
        },
        storeDonations(state, newRequest) {
            state.assistantDonations = newRequest
        },
    },
    getters: {
        assistantRequests: (state) => state.assistantRequests,
        assistantDonations: (state) => state.assistantDonations,

    },
    actions: {
        getAssistantRequests(context) {
            return axios.get('/api/blood/requests')
                .then(response => context.commit('storeAssistantRequests', response.data))
        },
        assignContainers(context,data){
            return axios.post('/api/assistant/blood/assign',data)
                .then(response => console.log(response.data) )
        },
        getDonations(context) {
            return axios.get('/api/assistant/donations')
                .then(response => context.commit('storeDonations', response.data))
        },

        updateDonation(context, data)
        {
            return axios.post('/api/assistant/donation')
        }

    }
}