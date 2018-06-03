export default {
    state: {
        requests: []
    },
    mutations: {
                storeRequest(state, newRequest) {
            state.requests = newRequest
        }

    },
    getters: {
        requests: (state) => state.requests

    },
    actions: {
        createRequest(context, data) {
            return axios.post('/api/blood/request', data)
                .then(() => context.dispatch('getRequests'))
        },
        getRequests(context) {
            return axios.get('/api/blood/request/history')
                .then(response => context.commit('storeRequest', response.data))
        }
    }
}