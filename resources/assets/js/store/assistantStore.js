export default {
    state: {
        assistantRequests: [],
    },
    mutations: {
        storeAssistantRequests(state, newRequest) {
            state.assistantRequests = newRequest
        },
    },
    getters: {
        assistantRequests: (state) => state.assistantRequests,
    },
    actions: {
        getAssistantRequests(context) {
            return axios.get('/api/blood/requests')
                .then(response => context.commit('storeAssistantRequests', response.data))
        },
        assignContainers(context,data){
            return axios.post('/api/assistant/blood/assign',data)
                .then(() =>context.dispatch('getAssistantRequests'))
        }
    }
}