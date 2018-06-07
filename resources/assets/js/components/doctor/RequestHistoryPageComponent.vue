<template>
    <div>
        <h2>Blood Requests History</h2><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col">Requested on</th>
                <th scope="col">Urgency</th>
                <th scope="col">Red cells</th>
                <th scope="col">Thrombocytes</th>
                <th scope="col">Plasma</th>
                <th scope="col">Blood type</th>
                <th scope="col">Completed At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="request in requests" :key="request.id">
                <td>{{request.created_at}}</td>
                <td>{{request.urgency_level}}</td>
                <td>{{ request.red_cells_containers_count}} / {{request.red_blood_cells_quantity}}</td>
                <td>{{ request.thrombocyte_containers_count}} / {{request.thrombocyte_quantity}}</td>
                <td>{{ request.plasma_containers_count}} / {{request.plasma_quantity}}</td>
                <td>{{ request.blood_type}}{{request.rh}}</td>
                <td>{{request.status_date}}</td>
            </tr>
            </tbody>
        </table>


    </div>

</template>

<script>
    export default {
        computed: {
            requests() {
                return this.$store.getters.requests;
            }
        },
        created() {
            this.$store.dispatch('getRequests');
        },
        methods: {}
    }
</script>

<style scoped>

</style>