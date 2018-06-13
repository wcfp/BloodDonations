<template>
    <table class="table table-light">
        <thead>
        <tr>
            <th>#</th>
            <th>Store date</th>
            <th>Type</th>
            <th>Blood type</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in containers">
            <td>{{item.identifier}}</td>
            <td>{{ item.store_date}}</td>
            <td>{{item.type}}</td>
            <th>{{item.donation.donor.blood_type}}{{item.donation.donor.rh}}</th>
            <th>
               {{item.expired ? "Expired" : item.blood_request_id ? "Delivered" : "In stock (expires in " + item.expiresIn + " days)" }}
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
