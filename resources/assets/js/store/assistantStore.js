export default {
    state: {
        appointments: []
    },

    getters: {
        appointments: (state) => state.appointments()

    },
    actions: {
        createRequest(context, data) {
            return axios.post('/api/appointments', data)
                .then(response => context.dispatch('getRequest'))
                .catch(reason => console.log(reason.response));
        },
        getRequest(context) {
            return axios.get('/api/appointments')
                .then(response => context.commit('storeRequest', response.data))
                .catch(reason => console.log(reason.response));
        }
    }
}