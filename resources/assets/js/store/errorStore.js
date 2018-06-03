export default {
    state: {
        errors: []
    },
    mutations: {
        addError(state, error) {
            error.forEach(e => {
                console.log(e);
                if (!state.errors.find(el => el === e)) {
                    state.errors.push(e)
                }
            });
        },
        clearErrors(state) {
            state.errors = []
        }

    },
    getters: {
        errors: (state) => state.errors
    },
}