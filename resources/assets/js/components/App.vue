<template>
    <div class="container-fluid p-0">
        <app-navbar></app-navbar>
        <div class="container-fluid p-0" v-if="isFullPage">
            <router-view></router-view>
        </div>
        <div class="container mt-5" v-else>
            <errors></errors>
            <div class="col">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            isFullPage() {
                return this.$route.path === "/" && !this.$store.getters.loggedIn;
            }
        },
        beforeCreate() {
            this.$store.dispatch('autologin')
        }
    }
</script>
