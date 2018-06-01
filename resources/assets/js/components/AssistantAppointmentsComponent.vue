<template>
    <div>
        <h2>Appointments</h2><br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Appointment Date</th>
                <th scope="col">Status</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="appointment in appointments">
                <td>{{appointment.appointment_date}}</td>
                <td>{{appointment.status.toUpperCase()}}</td>
                <td>{{appointment.status_date}}</td>
            </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
    export default {
        name: "AssistantAppointmentsComponent",
        computed: {
            appointments(){
                return this.$store.getters.appointments;
            }
        },
        mounted() {
            this.$store.dispatch('getAppointments');
        }

    }
</script>

<style scoped>

</style>