<template>
    <div class="col-xs-12 col-sm-10 offset-sm-1">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="age" class="sr-only">Age</label>
                    <input id="age" class="form-control col" type="text" v-model="age" placeholder="Age">
                </div>
                <div class="form-group">
                    <label for="weight" class="sr-only">Weight</label>
                    <input id="weight" class="form-control col" type="weight" v-model="weight" placeholder="Weight">
                </div>
                <div class="form-group">
                    <label for="rh" class="sr-only">Rh</label>
                    <input id="rh" class="form-control col" type="rh" v-model="rh" placeholder="Rh">
                </div>
                <div class="form-group">
                    <label for="blood_type" class="sr-only">Blood Type</label>
                    <input id="blood_type" class="form-control col" type="blood_type" v-model="blood_type"
                           placeholder="Blood Type">
                </div>
                <div class="row">
                    <h5 class="col">Current Address</h5>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="current_country" class="sr-only">Country</label>
                        <input id="current_country" v-model="current_country" type="text" class="form-control"
                               placeholder="Country">
                    </div>
                    <div class="form-group col">
                        <label for="current_city" class="sr-only">City</label>
                        <input id="current_city" v-model="current_city" type="text" class="form-control"
                               placeholder="City">
                    </div>
                    <div class="form-group col">
                        <label for="current_street" class="sr-only">Street</label>
                        <input id="current_street" v-model="current_street" type="text" class="form-control"
                               placeholder="Street">
                    </div>
                    <div class="form-group col">
                        <label for="current_number" class="sr-only">Number</label>
                        <input id="current_number" v-model="current_number" type="text" class="form-control"
                               placeholder="Number">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" v-model="other_residence_address"
                                   id="different_residence">
                            <label class="form-check-label" for="different_residence"><h5>Different residence</h5></label>
                        </div>
                    </div>
                </div>
                <div class="row" v-show="other_residence_address">
                    <div class="form-group col">
                        <label for="residence_country" class="sr-only">Country</label>
                        <input id="residence_country" v-model="residence_country" type="text" class="form-control"
                               placeholder="Country">
                    </div>
                    <div class="form-group col">
                        <label for="residence_city" class="sr-only">City</label>
                        <input id="residence_city" v-model="residence_city" type="text" class="form-control"
                               placeholder="City">
                    </div>
                    <div class="form-group col">
                        <label for="residence_street" class="sr-only">Street</label>
                        <input id="residence_street" v-model="residence_street" type="text" class="form-control"
                               placeholder="Street">
                    </div>
                    <div class="form-group col">
                        <label for="residence_number" class="sr-only">Number</label>
                        <input id="residence_number" v-model="residence_number" type="text" class="form-control"
                               placeholder="Number">
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary btn-block">Add info</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                age: "",
                weight: "",
                rh: "",
                blood_type: "",
                other_residence_address: false,
                current_country:"",
                current_city:"",
                current_street:"",
                current_number:"",
                residence_country:"",
                residence_city:"",
                residence_street:"",
                residence_number:""
            }
        },
        methods: {
            addInfot() {
                this.$store.dispatch('addInfo')
                    .then(response => this.$router.push('/'));
            }
        }
    }</script>

<style scoped>

</style>