<template>
    <div>
        <h2>Donations </h2><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col">Donor</th>
                <th scope="col">Appointment date</th>
                <th scope="col">Status</th>
                <th scope="col">Status date</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="donation in donations" :key="donation.id">
                <td>{{donation.donor.user.name}} {{donation.donor.user.surname}}</td>
                <td>{{donation.appointment_date}}</td>
                <td>{{donation.status}}</td>
                <td>{{donation.status_date}}</td>
                <td>Move to next stage</td>
                <td>Reject</td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        computed: {
            donations() {
                return this.$store.getters.assistantDonations;
            }
        },

        created() {
            this.$store.dispatch('getDonations');
        }
    }
</script>

<style scoped>

</style>