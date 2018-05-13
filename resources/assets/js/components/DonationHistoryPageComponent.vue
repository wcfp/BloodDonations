<template>
    <div>

        <div v-for="donation in donations">
            {donation.appointment_date}
        </div>

    </div>

</template>

<script>
    export default {
        computed: {
            donations() {
                return this.$store.getters.donations;
            }
        },
    }
</script>

<style scoped>

</style>