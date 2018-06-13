<template>
    <div>
        <h2>Donations </h2><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Donor</th>
                <th scope="col">Appointment date</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="donation in donations" :key="donation.id">
                <td>{{donation.identifier}}</td>
                <td>{{donation.donor.user.name}} {{donation.donor.user.surname}}</td>
                <td>{{donation.appointment_date}}</td>
                <td class="text-capitalize">{{donation.status}} at {{donation.status_date}}</td>
                <td>
                    <button v-if="showButtons(donation)" type="button" class="btn btn-outline-primary btn-block" @click="next(donation)">{{donation.stageMessage}}</button>
                </td>
                <td>
                    <button v-if="showButtons(donation)" type="button" class="btn btn-outline-danger btn-block" @click="reject(donation)">Reject</button>
                </td>


            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import RejectionModal from "./RejectionModal";
    import FillDonationDataComponent from "./FillDonationDataComponent";
    import FillBloodTypeModal from "./FillBloodTypeModal";

    export default {
        computed: {
            donations() {
                return this.$store.getters.assistantDonations;
            },
        },

        created() {
            this.$store.dispatch('getDonations');
        },
        methods: {
            next(donation) {
                if (donation.status === "requested") {
                    this.$modal.show(FillDonationDataComponent, {
                        donation: donation
                    });
                } else if (donation.status === "collected") {
                    this.$modal.show(FillBloodTypeModal, {
                        donation: donation
                    });
                } else {
                    axios.post(donation.nextStagePath).then(() => this.$store.dispatch('getDonations'))
                }
            },
            reject(donation) {
                this.$modal.show(RejectionModal, {
                    donation: donation
                });
            },
            showButtons(donation) {
                return donation.status !== "stored" && donation.status !== "rejected";
            },
        }
    }
</script>