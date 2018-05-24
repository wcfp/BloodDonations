<template>
    <div>
        <h2>Please choose the date for your next appointment: </h2>
        <div class="col-xs-12 col-sm-10 offset-sm-1">

            <div class="form-group">
                <label for="appointment_date" class="sr-only">DATE: </label>
                <input id="appointment_date" class="form-control col" type="date" v-model="date">
            </div>

        </div>

        <button @click="createAppointment()">Save date</button>
    </div>

</template>

<script>
    export default {
        data()
        {
            return {
            date: ""
        }},

        methods: {
            createAppointment() {
                console.log(this.date);
                this.$store.dispatch('createAppointment', {date: this.date.format('Y-m-d H:i:s')})
                    .then(response => this.$router.push('/'));
            }
        }}
</script>

<style scoped>

</style>