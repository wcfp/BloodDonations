<template>

    <div class="container d-flex align-items-center flex-column justify-content-between h-100 p-2">

        <h5 class="flex-grow-0 text-primary">Rejection Reason</h5>

        <textarea title="Rejection reason" class="form-control flex-grow-1" v-model="reason"></textarea>

        <button type="button" class="btn btn-primary btn-block" @click="sendReason">Submit</button>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                reason: "",
            }
        },
        props: ['donation'],
        methods: {
            sendReason() {
                //console.log("b");
                axios.post('/api/assistant/donation/' + this.donation.id + '/reject', {reason: this.reason})
            }

        },
    }
</script>