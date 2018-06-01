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
            <tr v-for="appointment in followingAppointments">
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
            followingAppointments(){
                return this.$store.getters.followingAppointments;
            }
        },
        mounted() {
            this.$store.dispatch('getFollowingAppointments');
        }

    }
</script>

<style scoped>

</style>