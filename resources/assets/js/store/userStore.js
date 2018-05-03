export default {
    state: {
        loggedIn: false,
        token: '',
        name: '',
        surname: '',
        role: ''
    },
    mutations: {
        userinfo(state, name, surname, role) {
            state.name = name;
            state.surname = surname;
            state.role = role;
        },
        logout(state) {
            state.loggedIn = false;
            window.sessionStorage.removeItem("jwtToken")
        },
        storeToken(state, token) {
            state.token = token;
            window.sessionStorage.setItem("jwtToken", token);
            window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
            state.loggedIn = true;
        }
    },
    getters: {
        token: (state) => state.token,
        loggedIn: (state) => state.loggedIn,
        name: (state) => state.name,
        surname: (state) => state.surname,
        role: (state) => state.role,
    },
    actions: {
        userinfo(context) {
            return axios.get('/api/auth/me').then((response) => {
                context.commit('userinfo', response.data.name, response.data.surname, response.data.role);
                return true;
            }).catch((reason) => {
                console.log(reason.response);
                return false;
            });
        },
        logout(context) {
            return axios.post('/api/auth/logout').then(() => {
                context.commit('logout');
                return true;
            }).catch((reason) => {
                console.log(reason.response);
                return false;
            });
        },
        login(context, data) {
            return axios.post('/api/auth/login', data).then((response) => {
                console.log(response);
                context.commit('storeToken', response.data.access_token);
                return context.dispatch('userinfo');
            }).catch((reason) => {
                console.log(reason.response.data.errors);
                return reason.response.data.errors;
            })
        },
        register(context, data) {
            return axios.post('/api/auth/register', data).then((response) => {
                console.log(response);
                context.commit('storeToken', response.data.access_token);
                return context.dispatch('userinfo');
            }).catch((reason) => {
                console.log(reason.response.data.errors);
                return reason.response.data.errors;
            })
        },
        autologin(context) {
            const token = window.sessionStorage.getItem("jwtToken");
            if (!token) {
                return false;
            }
            context.commit('storeToken', token);
            return context.dispatch('userinfo');
        }

    }
}