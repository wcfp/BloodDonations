<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="pulse" class="sr-only">Pulse</label>
                    <input id="pulse" class="form-control col" type="number"
                           v-model="pulse" placeholder="Pulse">
                </div>
                <div class="form-group">
                    <label for="blood_pressure_systolic" class="sr-only">Blood pressure systolic</label>
                    <input id="blood_pressure_systolic" class="form-control col" type="number"
                           v-model="blood_pressure_systolic" placeholder="Blood pressure systolic">
                </div>
                <div class="form-group">
                    <label for="blood_pressure_diastolic" class="sr-only">Blood pressure diastolic</label>
                    <input id="blood_pressure_diastolic" class="form-control col" type="number" v-model="blood_pressure_diastolic"
                           placeholder="Blood pressure diastolic">
                </div>
                <div class="form-group">
                    <label for="consumed_fat" class="sr-only">Consumed fat</label>
                    <input id="consumed_fat" class="form-control col" type="checkbox" v-model="consumed_fat"
                           placeholder="Consumed fat">
                </div>
                <div class="form-group">
                    <label for="has_smoked" class="sr-only">Has smoked</label>
                    <input id="has_smoked" class="form-control col" type="checkbox" v-model="has_smoked" placeholder="Has smoked">
                </div>
                <div class="form-group">
                    <label for="sleep_quality" class="sr-only">Sleep quality</label>
                    <input id="sleep_quality" class="form-control col" type="number" v-model="sleep_quality"
                           placeholder="Sleep quality">
                <button class="btn btn-primary btn-block" @click="updateDonation">Update Donation</button>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
      data() {
          return {
              pulse:"",
              blood_pressure_systolic:"",
              blood_pressure_diastolic:"",
              consumed_fat:"",
              consumed_alcohol:"",
              has_smoked:"",
              sleep_quality:""
          }
      },
        methods: {
            updateDonation() {
                this.$store.dispatch('updateDonation', {
                    pulse: this.pulse,
                    blood_pressure_systolic: this.blood_pressure_systolic,
                    blood_pressure_diastolic: this.blood_pressure_diastolic,
                    consumed_fat: this.consumed_fat,
                    consumed_alcohol: this.consumed_alcohol,
                    has_smoked: this.has_smoked,
                    sleep_quality: this.sleep_quality,
                })
                    .then(response => this.$router.push(''));
            }
        }
    }
</script>

<style scoped>

</style>