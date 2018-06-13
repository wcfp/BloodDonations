<template>

    <div class="container d-flex align-items-center flex-column justify-content-around h-100 p-2">

        <h5 class="flex-grow-0 text-primary">Analysis result</h5>
        <form @submit.prevent="sendResult">

            <div class="form-group">
                <label for="rh" class="sr-only">Rh</label>
                <input id="rh" class="form-control col" type="text" v-model="rh" placeholder="Rh">
            </div>
            <div class="form-group">
                <label for="blood_type" class="sr-only">Blood Type</label>
                <input id="blood_type" class="form-control col" type="text" v-model="blood_type" placeholder="Blood Type">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                rh: "",
                blood_type: "",
            }
        },
        props: ['donation'],
        methods: {
            sendResult() {
                axios.post(this.donation.nextStagePath, {rh: this.rh, blood_type: this.blood_type}).then(() => {
                    this.$store.dispatch('getDonations').then(() => this.$emit('close'))
                })
            }

        },
    }
</script>