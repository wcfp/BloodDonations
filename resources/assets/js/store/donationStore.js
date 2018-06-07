export default {
    state: {
        donations: []
    },
    mutations: {
        storeDonations(state, newDonations) {
            state.donations = newDonations
        }
    },
    getters: {
        donations: (state) => state.donations
    },
    actions: {
        createAppointment(context, data) {
            return axios.post('/api/donor/appointments', data)
                .then(() => context.dispatch('getAppointments'))
        },
        getAppointments(context) {
            return axios.get('/api/donor/appointments')
                .then(response => context.commit('storeDonations', response.data))
        }
    }
}