<template>
    <div>
        <h2>Requests History</h2><br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Urgency</th>
                <th scope="col">Status</th>
                <th scope="col">Updated At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="request in requests">
                <td>{{request.urgency_level}}</td>
                <td>{{request.status}}</td>
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
    }
</script>

<style scoped>

</style>