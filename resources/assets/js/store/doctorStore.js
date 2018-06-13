export default {
    state: {
        requests: [],
        ongoingRequests: [],
    },
    mutations: {
        storeRequest(state, newRequest) {
            state.requests = newRequest
        },
        storeOngoingRequests(state, ongoingRequests) {
            state.ongoingRequests = ongoingRequests
        }

    },
    getters: {
        requests: (state) => state.requests,
        ongoingRequests: (state) => state.ongoingRequests,
    },
    actions: {
        createRequest(context, data) {
            return axios.post('/api/blood/request', data)
                .then(() => context.dispatch('getOngoingRequests'))
        },
        getRequests(context) {
            return axios.get('/api/blood/request/history')
                .then(response => context.commit('storeRequest', response.data))
        },
        getOngoingRequests(context) {
            return axios.get('/api/doctor/requests')
                .then(response => context.commit('storeOngoingRequests', response.data))
        }
    }
}