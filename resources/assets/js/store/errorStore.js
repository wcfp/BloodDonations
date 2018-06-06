export default {
    state: {
        errors: []
    },
    mutations: {
        addError(state, errors) {
            if (errors) {
                state.errors = Object.values(errors).map(value => typeof value === "string" ? value : value.join(""));
            }
        },
        clearErrors(state) {
            state.errors = []
        }

    },
    getters: {
        errors: (state) => state.errors
    },
}