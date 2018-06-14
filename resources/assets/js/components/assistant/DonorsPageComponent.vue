<template>
    <table class="table table-light">
        <thead>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Blood type</th>
            <th>Distance</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in donors">
            <td>{{item.user.email}}</td>
            <td>{{item.user.name}} {{item.user.surname}}</td>
            <td>{{ item.blood_type}}{{item.rh}}</td>
            <td>{{item.distance}}</td>
            <th>
                <span v-if="!item.is_allowed">Not allowed</span>
                <span v-else-if="!item.canDonate">Resting</span>
                <button v-else class="btn btn-outline-primary" @click="sendMail(item)">Call for donation</button>
            </th>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        computed: {
            donors() {
                return this.$store.getters.donors;
            }
        },
        created() {
            this.$store.dispatch('getDonors');
        },
        methods: {
            sendMail(donor) {
                axios.post('/api/assistant/donor/' + donor.id + '/mail')
            }
        }
    }
</script>
