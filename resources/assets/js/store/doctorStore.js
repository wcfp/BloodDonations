export default {
    state: {
        requests: []
    },
    mutations: {
                storeRequest(state, newRequest) {
            state.request = newRequest
        }

    },
    getters: {
        requests: (state) => state.requests

    },
    actions: {
        createRequest(context, data) {
            return axios.post('/api/blood/request', data)
                .then(response => context.dispatch('getRequest'))
                .catch(reason => console.log(reason.response));
        },
        getRequest(context) {
            return axios.get('/api/blood/request')
                .then(response => context.commit('storeRequest', response.data))
                .catch(reason => console.log(reason.response));
        }
    }
}