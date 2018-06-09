<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <h2 align="center">Edit Profile </h2><br>
        <div class="card">
            <div class="card-body">
                <form>
                    <h5> Login Information </h5>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" class="form-control col" type="email" v-model="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" class="form-control col" type="text" v-model="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="surname" class="sr-only">Surname</label>
                        <input id="surname" class="form-control col" type="text" v-model="surname"
                               placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" class="form-control col" type="password" v-model="password"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="sr-only">Password</label>
                        <input id="password_confirmation" class="form-control col" type="password"
                               v-model="passwordConfirmation" placeholder="Confirm password">
                    </div>
                </form>
            </div>
        </div>
        <br><br>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="f()">
                    <h5>Personal Information </h5>
                    <div class="form-group">
                        <label for="cnp" class="sr-only">CNP</label>
                        <input id="cnp" class="form-control col" type="cnp" v-model="cnp" placeholder="CNP" >
                    </div>
                    <div class="form-group">
                        <label for="age" class="sr-only">Age</label>
                        <input id="age" class="form-control col" type="age" v-model="age" placeholder="Age">
                    </div>
                    <div class="form-group">
                        <label for="weight" class="sr-only">Weight</label>
                        <input id="weight" class="form-control col" type="text" v-model="weight" placeholder="Weight">
                    </div>
                    <div class="form-group">
                        <label for="rh" class="sr-only">Rh</label>
                        <input id="rh" class="form-control col" type="text" v-model="rh" placeholder="Rh">
                    </div>
                    <div class="form-group">
                        <label for="blood" class="sr-only">Blood Type</label>
                        <input id="blood" class="form-control col" type="text" v-model="blood" placeholder="Blood Type">
                    </div>
                    <div class="row">
                        <h5 class="col">Current Address</h5>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="currCountry" class="sr-only">Country</label>
                            <input id="currCountry" type="text" placeholder="Country" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="currCity" class="sr-only">City</label>
                            <input id="currCity" type="text" placeholder="City" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="currStreet" class="sr-only">Streety</label>
                            <input id="currStreet" type="text" placeholder="Street" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="currNumber" class="sr-only">Number</label>
                            <input id="currNumber" type="text" placeholder="Number" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-check">
                                <input type="checkbox" id="diffResidence" class="form-check-input"
                                       v-model="other_residence_address">
                                <label for="diffResidence" class="form-check-label">
                                    <h5>Different Residence</h5>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-show="other_residence_address">
                        <div class="form-group col">
                            <label for="resCountry" class="sr-only">Country</label>
                            <input id="resCountry" type="text" placeholder="Country" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="resCity" class="sr-only">City</label>
                            <input id="resCity" type="text" placeholder="City" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="resStreet" class="sr-only">Streety</label>
                            <input id="resStreet" type="text" placeholder="Street" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="resNumber" class="sr-only">Number</label>
                            <input id="resNumber" type="text" placeholder="Number" class="form-control">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-block" value="Save Changes">
                </form>
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
                cnp: "",
                blood: "",
                other_residence_address: false,
                currCountry: "",
                currCity: "",
                currStreet: "",
                currNumber: "",
                resCountry: "",
                resCity: "",
                resStreet: "",
                resNumber: ""
            }
        },
        methods: {
            f() {
                console.log(event);
            }
        }
    }
</script>

<style scoped>

</style>