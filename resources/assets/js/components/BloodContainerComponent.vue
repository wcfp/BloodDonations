<template>
    <table class="table table-light">
        <tr>
            <th>Store date</th>
            <th>Type</th>
            <th>Quantity(ml)</th>
            <th>Blood type</th>
        </tr>

        <tr v-for="item in containers">
            <td>{{ item.store_date}}</td>
            <td>{{item.type}}</td>
            <td>{{item.quantity}}</td>
            <th>{{item.donation.donor.blood_type}}{{item.donation.donor.rh}}</th>
        </tr>
    </table>
</template>

<script>
    export default {
        computed: {
            containers() {
                return this.$store.getters.containers;
            }
        },
        mounted() {
            this.$store.dispatch('getContainers');
        }
    }
</script>
