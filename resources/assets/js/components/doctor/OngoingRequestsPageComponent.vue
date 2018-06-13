<template>
    <div>
        <h2>Ongoing requests</h2><br>
        <table class="table table-hover">

            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Requested on</th>
                <th scope="col">Urgency</th>
                <th scope="col">Red cells</th>
                <th scope="col">Thrombocytes</th>
                <th scope="col">Plasma</th>
                <th scope="col">Blood type</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="request in ongoingRequests" :key="request.id">
                <td>{{request.identifier}}</td>
                <td>{{request.created_at}}</td>
                <td>{{request.urgency_level}}</td>
                <td>{{ request.red_cells_containers_count}} / {{request.red_blood_cells_quantity}}</td>
                <td>{{ request.thrombocyte_containers_count}} / {{request.thrombocyte_quantity}}</td>
                <td>{{ request.plasma_containers_count}} / {{request.plasma_quantity}}</td>
                <td>{{ request.blood_type}}{{request.rh}}</td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        computed: {
            ongoingRequests() {
                return this.$store.getters.ongoingRequests;
            }
        },

        created() {
            this.$store.dispatch('getOngoingRequests');
        }
    }
</script>

<style scoped>

</style>