<template>
    <div>
        <h2>Appointments History</h2><br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Appointment Date</th>
                <th scope="col">Status</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="donation in donations">
                <td>{{donation.appointment_date}}</td>
                <td>{{donation.status.toUpperCase()}}</td>
                <td>{{donation.status_date}}</td>
            </tr>
            </tbody>
        </table>


    </div>

</template>

<script>
    export default {
        computed: {
            donations() {
                return this.$store.getters.donations;
            }
        }
    }
</script>

<style scoped>

</style>