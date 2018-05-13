<template>
    <div>
        <h2>Please choose the date for your next appointment: </h2>
        <button @click="createAppointment()">Test</button>
    </div>

</template>

<script>
    export default {

        methods: {
            createAppointment() {
                this.$store.dispatch('createAppointment', {date: '2018-05-20 09:20:00'})
                    .then(response => this.$router.push('/history'));
            }
        }
    }
</script>

<style scoped>

</style>