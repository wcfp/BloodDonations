<template>
    <table class="table table-light">
        <thead>
        <tr>
            <th>Store date</th>
            <th>Type</th>
            <th>Blood type</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in containers">
            <td>{{ item.store_date}}</td>
            <td>{{item.type}}</td>
            <th>{{item.donation.donor.blood_type}}{{item.donation.donor.rh}}</th>
            <th>
                <p v-if="item.blood_request_id==null"><i>Available</i></p>
                <p v-else><i>Used</i></p>
            </th>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        computed: {
            containers() {
                return this.$store.getters.containers;
            }
        },
        created() {
            this.$store.dispatch('getContainers');
        }
    }
</script>
