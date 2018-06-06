<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="registerInvite()">
                    <h4>Register as {{userType}}</h4>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" class="form-control col" type="email" :value="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" class="form-control col" type="text" v-model="name" placeholder="Name"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="sr-only">Surname</label>
                        <input id="surname" class="form-control col" type="text" v-model="surname" placeholder="Surname"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" class="form-control col" type="password" v-model="password"
                               placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="sr-only">Password</label>
                        <input id="password_confirmation" class="form-control col" type="password"
                               v-model="passwordConfirmation" placeholder="Confirm password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Register">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                userType: "",
                name: "",
                surname: "",
                password: "",
                passwordConfirmation: ""
            }
        },
        methods: {
            registerInvite() {
                axios.post('/api/auth/invitation/register', {
                    token: this.$route.query.token,
                    surname: this.surname,
                    name: this.name,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                }).then(response => {
                    this.$store.commit('storeToken', response.data.access_token);
                    this.$store.dispatch('userinfo').then(() => {
                        this.$router.replace('/');
                    });
                });
            },
            getInvitationData() {
                axios.get('/api/invitation?token=' + this.$route.query.token)
                    .then(response => {
                        this.userType = response.data.role;
                        this.email = response.data.email;
                    }).catch(() => this.$router.replace('/'));
            }
        },
        created() {
            this.getInvitationData();
        }
    }
</script>

<style scoped>

</style>