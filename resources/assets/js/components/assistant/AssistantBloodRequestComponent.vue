<template>
    <table class="table table-light">
        <tr>
            <th>Red Cells Containers Left</th>
            <th>Thrombocyte Containers Left</th>
            <th>Plasma Containers Left</th>
            <th>Blood type</th>
            <th>Urgency level</th>
            <th>Change status</th>
        </tr>

        <tr v-for="request in blood_requests">
            <td>{{ request.red_cells_containers_count}} / {{request.red_blood_cells_quantity}}</td>
            <td>{{ request.thrombocyte_containers_count}} / {{request.thrombocyte_quantity}}</td>
            <td>{{ request.plasma_containers_count}} / {{request.plasma_quantity}}</td>
            <th>{{request.blood_type}}{{request.rh}}</th>
            <th>{{request.urgency_level}}</th>
            <th>
                <button v-if="request.status=='requested'" class="btn btn-primary"  @click="assignContainers(request)">Assign Containers</button>
                <p v-else><i>Done</i></p>
            </th>
        </tr>
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
        methods:{
            assignContainers($bloodRequest){
                this.$store.dispatch('assignContainers',{'blood_request':$bloodRequest});
            }
        }
    }
</script>

<style scoped>

</style>