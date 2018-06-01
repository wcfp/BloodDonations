<template>
    <div>
        <h2>Please choose the date for your next appointment: </h2>
        <p v-if="errors.length>0" class="text-danger">{{errors[0]}}</p>
        <button @click="createAppointment()">Create</button>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                errors: {}
            }
        },
        methods: {
            createAppointment() {
                this.$store.dispatch('createAppointment', {date: '2018-07-08 09:20:00'})
                    .then(response => this.$router.push('/history'))
                    .catch(error => {
                        //console.log(error);
                        this.errors = error.data.message;
                    });
            }
        }
    }
</script>

<style scoped>

</style>