export default {
    state: {
        followingAppointments: []
    },

    getters: {
        followingAppointments: (state) => state.followingAppointments

    },
    mutations: {
        storeAppointments(state, newApp) {
            state.followingAppointments = newApp
        }
    },
    actions: {
        getFollowingAppointments(context) {
            return axios.get('/api/assistant/appointments')
                .then(response => context.commit('storeAppointments', response.data))
                .catch(reason => console.log(reason.response));
        }
    }
}