export default {
    state: {
        containers: []
    },
    mutations: {
        storeContainers(state, newContainers) {
            state.containers = newContainers
        }
    },
    getters: {
        containers: (state) => state.containers
    },
    actions: {
        getContainers(context) {
            return axios.get('/api/assistant/containers')
                .then(response => context.commit('storeContainers', response.data))
                .catch(reason => console.log(reason.response));
        }
    }
}