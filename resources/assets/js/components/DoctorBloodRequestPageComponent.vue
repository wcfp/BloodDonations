<!--<script src="FontAwesomeIcon.js"></script>-->
<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="red_blood_cells_quantity" class="sr-only">Red blood cell quantity</label>
                    <input id="red_blood_cells_quantity" class="form-control col" type="number"
                           v-model="red_blood_cells_quantity" placeholder="Red blood cell quantity">
                </div>
                <div class="form-group">
                    <label for="thrombocyte_quantity" class="sr-only">thrombocyte_quantity</label>
                    <input id="thrombocyte_quantity" class="form-control col" type="number"
                           v-model="thrombocyte_quantity" placeholder="Thrombocyte quantity">
                </div>
                <div class="form-group">
                    <label for="plasma_quantity" class="sr-only">Plasma quantity</label>
                    <input id="plasma_quantity" class="form-control col" type="number" v-model="plasma_quantity"
                           placeholder="Plasma quantity">
                </div>
                <div class="form-group">
                    <label for="blood_type" class="sr-only">Blood type</label>
                    <input id="blood_type" class="form-control col" type="text" v-model="blood_type"
                           placeholder="Blood type">
                </div>
                <div class="form-group">
                    <label for="rh" class="sr-only">RH</label>
                    <input id="rh" class="form-control col" type="text" v-model="rh" placeholder="RH">
                </div>
                <div class="form-group">
                    <label for="urgency_level" class="sr-only">Urgency level</label>
                    <input id="urgency_level" class="form-control col" type="text" v-model="urgency_level"
                           placeholder="Urgency level">
                </div>
                <div class="form-group">
                    <label for="country" class="sr-only">Country</label>
                    <input id="country" v-model="country" type="text" class="form-control"
                           placeholder="Country">
                </div>
                <div class="form-group">
                    <label for="current_city" class="sr-only">City</label>
                    <input id="current_city" v-model="city" type="text" class="form-control"
                           placeholder="City">
                </div>
                <div class="form-group">
                    <label for="current_street" class="sr-only">Street</label>
                    <input id="current_street" v-model="street" type="text" class="form-control"
                           placeholder="Street">
                </div>
                <div class="form-group">
                    <label for="current_number" class="sr-only">Number</label>
                    <input id="current_number" v-model="number" type="number" class="form-control"
                           placeholder="Number">
                </div>
                <button class="btn btn-primary btn-block" @click="createRequest">Register request</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                red_blood_cells_quantity: "",
                thrombocyte_quantity: "",
                plasma_quantity: "",
                blood_type: "",
                rh: "",
                urgency_level: "",
                country: "",
                city: "",
                number: "",
                street: "",

            }
        },
        methods: {
            createRequest() {
                console.log('create request -> doctor component')
                this.$store.dispatch('createRequest', {
                    red_blood_cells_quantity: this.red_blood_cells_quantity,
                    thrombocyte_quantity: this.thrombocyte_quantity,
                    plasma_quantity: this.plasma_quantity,
                    blood_type: this.blood_type,
                    rh: this.rh,
                    urgency_level: this.urgency_level,
                    country: this.country,
                    city: this.city,
                    number: this.number,
                    street: this.street
                })
                    .then(response => this.$router.push('/requests/history'));
            }
        }
    }
</script>

<style scoped>

</style>