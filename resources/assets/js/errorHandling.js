import store from './store/index'


window.axios.interceptors.response.use(
    response => {
        store.commit("clearErrors");
        return response;
    },
    error => {
        store.commit("addError", error.response.data.errors);
        return Promise.reject(error);
    }
);