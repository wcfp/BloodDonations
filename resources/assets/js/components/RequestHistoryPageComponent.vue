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
            <tr v-for="request in requests" :key="request.id" v-on:click="clickList(request)">
                <td>{{request.urgency_level}}</td>
                <td>{{request.status.toUpperCase()}}</td>
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
        mounted() {
            this.$store.dispatch('getRequests');
        },
        methods:
            {
                clickList: function (request) {
                    //console.log("clickList fired with " + request.id);
                }
            }
    }
</script>

<style scoped>

</style>