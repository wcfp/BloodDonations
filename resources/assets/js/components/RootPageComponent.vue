<template>
    <div v-if="loggedIn">
        <home-page />
    </div>
    <div v-else>
        <welcome-page />
    </div>
</template>

<script>

    export default {
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
