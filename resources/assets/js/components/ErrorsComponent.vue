<template>
    <div>
        <div class="alert alert-danger" role="alert" v-if="errors.length">
            <button type="button" class="close" @click="clearErrors">
                <span aria-hidden="true">&times;</span>
            </button>
            <p class="m-0 font-weight-bold" v-for="error in errors">
                {{ error }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$store.getters.errors;
            }
        },
        methods: {
            clearErrors() {
                this.$store.commit('clearErrors')
            }
        }
    }
</script>

<style scoped>

</style>