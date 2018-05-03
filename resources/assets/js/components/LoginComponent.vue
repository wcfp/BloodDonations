<template>
    <div class="col-xs-12 col-sm-6 offset-sm-3">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" class="form-control col" type="text" v-model="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" class="form-control col" type="text" v-model="password" placeholder="Password">
                </div>
                <button class="btn btn-primary btn-block" @click="login()">Login!</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: "",
            }
        },
        methods: {
            login() {
                this.$store
                    .dispatch("login", {email: this.email, password: this.password})
                    .then(() => this.$router.push('/'))
            }
        }
    }
</script>

<style scoped>

</style>