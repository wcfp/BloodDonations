<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="selectedDate">Please choose the date for your next appointment: </label>
                    <input id="selectedDate" class="form-control col" type="date" v-model="selectedDate">
                </div>
                <div class="form-group">
                    <label for="selectedTime">Please choose the time for your next appointment(hour:minute): </label>
                    <input id="selectedTime" class="form-control" type="text" v-model="selectedTime">
                </div>
                <button class="btn btn-primary btn-block" @click="createAppointment()">Save</button>
            </div>
        </div>
    </div>

</template>


<script>
    import moment from 'moment'

    export default {
        data: () => ({
            selectedDate: null,
            selectedTime: null,
            appointmentDate: null
        }),

        methods: {

            createAppointment() {
                this.selectedDate = moment(this.selectedDate).format('YYYY-MM-DD');
                this.appointmentDate = this.selectedDate + " " + this.selectedTime;
                this.$store.dispatch('createAppointment', {date: this.appointmentDate})
                    .then(response => this.$router.push('/'));
            }
        }
    }
</script>

<style scoped>

</style>