<template>
    <div>
        <h3>Please choose the date for your next appointment: </h3>
        <div style="margin-bottom:300px">
            <md-datepicker v-model="selectedDate" >
                <label>Select date</label>
            </md-datepicker>
        </div>
        <h3>Please choose the time for your next appointment: </h3>
        <md-field>
            <label>Select time (hour:minute:seconds)</label>
            <md-input v-model="selectedTime"></md-input>
        </md-field>
        <div class="container">
            <md-button class="md-raised md-accent" @click="createAppointment()">SAVE</md-button>
        </div>

    </div>
</template>



<script>
    import  moment from 'moment'
    export default {
        data: () => ({
            selectedDate: null,
            selectedTime: null,
            appointmentDate :null
        }),

        methods: {

            createAppointment() {
                this.selectedDate = moment(this.selectedDate).format('YYYY-MM-DD');
                this.appointmentDate=this.selectedDate+" "+this.selectedTime;
                console.log(this.appointmentDate);
                this.$store.dispatch('createAppointment', {date: this.appointmentDate})
                    .then(response => this.$router.push('/'));
            }
        }
    }
</script>

<style scoped>

</style>