<template>
    <div class="container-fluid p-0">
        <app-navbar></app-navbar>
        <div class="container mt-5">
            <div class="col">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$store.dispatch('autologin')
        }
    }
</script>

<style>

</style>