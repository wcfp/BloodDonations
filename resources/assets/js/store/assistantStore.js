export default {
    state: {
        appointments: []
    },

    getters: {
        appointments: (state) => state.appointments()

    },
    actions: {
        getAppointments(context) {
            return axios.get('/api/assistant/appointments')
                .then(response => context.commit('getAppointments', response.data))
                .catch(reason => console.log(reason.response));
        }
    }
}