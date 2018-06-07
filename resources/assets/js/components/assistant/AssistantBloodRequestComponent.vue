<template>
    <table class="table table-light">
        <tr>
            <th>Thrombocyte Containers Left</th>
            <th>Plasma Containers Left</th>
            <th>Red Cells Containers Left</th>
            <th>Blood type</th>
            <th>Urgency level</th>
            <th>Change status</th>
        </tr>

        <tr v-for="item in blood_requests">
            <td>{{item.thrombocyteContainersLeft}}</td>
            <td>{{item.plasmaContainersLeft}}</td>
            <td>{{item.redCellsContainersLeft}}</td>
            <th>{{item.blood_type}}{{item.rh}}</th>
            <th>{{item.urgency_level}}</th>
            <th><button class="btn btn-primary">Done</button></th>
        </tr>
    </table>
</template>

<script>
    export default {
        computed: {
            blood_requests() {
                return this.$store.getters.blood_requests;
            }
        },
        created() {
            this.$store.dispatch('getRequests');
        }
    }
</script>

<style scoped>

</style>