<template>
    <div id="user-controls">
        <ul class="navbar-nav">
            <li class="nav-item">
                <router-link v-if="loggedIn" :to="this.userType === 'DONOR' ? '/donor/profile' : ''" class="nav-link btn btn-link" tag="button">
                    <fa-icon icon="user-circle"/> {{ name }}
                </router-link>
                <router-link v-else to="/login" class="nav-link btn btn-link" tag="button">Login</router-link>
            </li>
            <li class="nav-item">
                <button v-if="loggedIn" @click="logout()" class="btn nav-link btn-link">Logout</button>
                <router-link v-else to="/register" class="nav-link btn btn-link" tag="button">Register</router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        computed: {
            name() {
                return this.$store.getters.name;
            },
            loggedIn() {
                return this.$store.getters.loggedIn;
            },
            userType() {
                return this.$store.getters.role;
            }
        },
        methods: {
            logout() {
               this.$store.dispatch('logout').then(() => this.$router.push('/'))
            },
        }
    }
</script>