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
                <td>
                    <button type="button" class="btn btn-outline-primary btn-block" @click="next(donation)">Next Stage</button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-block" @click="reject(donation)">Reject</button>
                </td>


            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import RejectionModal from "./RejectionModal";
    import FillDonationDataComponent from "./FillDonationDataComponent";

    export default {
        computed: {
            donations() {
                return this.$store.getters.assistantDonations;
            }
        },

        created() {
            this.$store.dispatch('getDonations');
        },
        methods: {
            reject(donation) {
                this.$modal.show(RejectionModal, {
                    donation: donation
                });
            },
            next(donation) {
                this.$modal.show(FillDonationDataComponent, {
                    donation: donation
                }, {
                    height: 'auto'
                });
            }
        }
    }
</script>