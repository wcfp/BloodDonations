import store from './store/index'


window.axios.interceptors.response.use(
    response => response,
    error => {
        Object.values(error.response.data.errors).forEach(values => {
            store.commit('addError', values)
        });
        return Promise.reject(error);
    }
);