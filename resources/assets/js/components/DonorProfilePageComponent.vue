<template>
    <div class="col-xs-12 col-sm-10 offset-sm-1">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="saveInfo()">
                    <div class="form-group">
                        <label for="birth_date" class="sr-only">Birth date</label>
                        <input id="birth_date" class="form-control col" type="date" v-model="birth_date" value="Birth date">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="sr-only">Phone number</label>
                        <input id="phone_number" class="form-control col" type="text" v-model="phone_number"
                               placeholder="Phone number">
                    </div>
                    <div class="form-group">
                        <label for="cnp" class="sr-only">CNP</label>
                        <input id="cnp" class="form-control col" type="text" v-model="cnp"
                               placeholder="CNP">
                    </div>
                    <div class="form-group">
                        <label for="weight" class="sr-only">Weight</label>
                        <input id="weight" class="form-control col" type="number" v-model="weight" placeholder="Weight">
                    </div>
                    <div class="form-group">
                        <label for="rh" class="sr-only">Rh</label>
                        <input id="rh" class="form-control col" type="text" v-model="rh" placeholder="Rh">
                    </div>
                    <div class="form-group">
                        <label for="blood_type" class="sr-only">Blood Type</label>
                        <input id="blood_type" class="form-control col" type="text" v-model="blood_type"
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
                                <h5><label class="form-check-label" for="different_residence">Different
                                    residence</label></h5>
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
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Save profile"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                birth_date: "",
                weight: "",
                rh: "",
                blood_type: "",
                other_residence_address: false,
                current_country: "",
                current_city: "",
                current_street: "",
                current_number: "",
                residence_country: "",
                residence_city: "",
                residence_street: "",
                residence_number: "",
                phone_number: "",
                cnp:""
            }
        },
        methods: {
            saveInfo() {
                this.$store.dispatch('saveInfo', {
                    weight: this.weight,
                    rh: this.rh,
                    cnp: this.cnp,
                    phone_number: this.phone_number,
                    blood_type: this.blood_type,
                    birth_date: this.birth_date,
                    residence_country: this.residence_country,
                    residence_city: this.residence_city,
                    residence_street: this.residence_street,
                    residence_number: this.residence_number,
                    current_country: this.current_country,
                    current_number: this.current_number,
                    current_city: this.current_city,
                    current_street: this.current_street,
                    residence_address: this.other_residence_address
                }).then(() => this.$router.push('/'));
            }
        }
    }</script>

<style scoped>

</style>