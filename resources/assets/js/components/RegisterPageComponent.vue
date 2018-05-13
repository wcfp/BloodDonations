<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
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
                    <input id="surname" class="form-control col" type="text" v-model="surname" placeholder="Surname">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" class="form-control col" type="password" v-model="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="sr-only">Password</label>
                    <input id="password_confirmation" class="form-control col" type="password" v-model="passwordConfirmation" placeholder="Confirm password">
                </div>
                <button class="btn btn-primary btn-block" @click="register()">Register</button>
            </div>
        </div>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                email: "",
                name: "",
                surname: "",
                password: "",
                passwordConfirmation: ""
            }
        },
        methods: {
            register() {
                this.$store.dispatch('register', {
                    email: this.email,
                    name: this.name,
                    surname: this.surname,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                }).then(() => this.$router.push('/profile'));
            }
        }

    }
</script>