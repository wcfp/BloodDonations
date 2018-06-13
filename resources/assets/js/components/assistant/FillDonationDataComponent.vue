<template>
    <div class="container m-1">
        <div class="form-group">
            <label for="pulse" class="sr-only">Pulse</label>
            <input id="pulse" class="form-control col" type="number"
                   v-model="pulse" placeholder="Pulse">
        </div>
        <div class="form-group">
            <label for="blood_pressure_systolic" class="sr-only">Systolic blood pressure </label>
            <input id="blood_pressure_systolic" class="form-control col" type="number"
                   v-model="blood_pressure_systolic" placeholder="Blood pressure systolic">
        </div>
        <div class="form-group">
            <label for="blood_pressure_diastolic" class="sr-only">Diastolic blood pressure </label>
            <input id="blood_pressure_diastolic" class="form-control col" type="number"
                   v-model="blood_pressure_diastolic"
                   placeholder="Blood pressure diastolic">
        </div>
        <div class="form-group">
            <label for="sleep_quality" class="sr-only">Sleep quality</label>
            <input id="sleep_quality" class="form-control col" type="number" v-model="sleep_quality"
                   placeholder="Sleep quality">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="fat">
                <label class="custom-control-label" for="fat">Consumed Fat</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="smoker">
                <label class="custom-control-label" for="smoker">Has Smoked</label>
            </div>

            <button class="btn btn-primary btn-block" @click="update">Update Donation</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pulse: "",
                blood_pressure_systolic: "",
                blood_pressure_diastolic: "",
                consumed_fat: "",
                consumed_alcohol: "",
                has_smoked: "",
                sleep_quality: ""

            }
        },
        props: ['donation'],
        methods: {
            update() {
                axios.post(this.donation.nextStagePath, {
                    pulse: this.pulse,
                    blood_pressure_systolic: this.blood_pressure_systolic,
                    blood_pressure_diastolic: this.blood_pressure_diastolic,
                    consumed_fat: this.consumed_fat,
                    consumed_alcohol: this.consumed_alcohol,
                    has_smoked: this.has_smoked,
                    sleep_quality: this.sleep_quality,
                }).then(() => {
                    this.$store.dispatch("getDonations").then(() => {
                        this.$emit('close')
                    })
                });
            }
        }
    }
</script>

<style scoped>

</style>