<template>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Red Cells Containers</th>
            <th>Thrombocyte Containers</th>
            <th>Plasma Containers</th>
            <th>Blood type</th>
            <th>Urgency level</th>
            <th>Change status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="request in blood_requests">
            <td>{{ request.identifier}}</td>
            <td>{{ request.red_cells_containers_count}} / {{request.red_blood_cells_quantity}}</td>
            <td>{{ request.thrombocyte_containers_count}} / {{request.thrombocyte_quantity}}</td>
            <td>{{ request.plasma_containers_count}} / {{request.plasma_quantity}}</td>
            <th>{{request.blood_type}}{{request.rh}}</th>
            <th>{{request.urgency_level}}</th>
            <th class="text-center">
                <button v-if="request.status === 'requested'" class="btn btn-outline-primary" @click="assignContainers(request)">Assign Containers</button>
                <p v-else><fa-icon icon="check" class="text-green"></fa-icon></p>
            </th>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        computed: {
            blood_requests() {
                return this.$store.getters.assistantRequests;
            }
        },
        created() {
            this.$store.dispatch('getAssistantRequests');
        },
        methods: {
            assignContainers(bloodRequest) {
                return axios.post('/api/assistant/request/' + bloodRequest.id + '/fulfill').then(response => {
                    this.$store.dispatch('getAssistantRequests')
                })
            }
        }
    }
</script>

<style scoped>

</style>