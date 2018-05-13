<script src="FontAwesomeIcon.js"></script>
<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="current_address" class="sr-only">Current Address</label>
                    <input id="current_address" class="form-control col" type="text" v-model="current_address" placeholder="Current Address">
                </div>
                <div class="form-group">
                    <label for="residence_address" class="sr-only">Residence Address</label>
                    <input id="residence_address" class="form-control col" type="text" v-model="residence_address" placeholder="Residence Address">
                </div>
                <div class="form-group">
                    <label for="age" class="sr-only">Age</label>
                    <input id="age" class="form-control col" type="text" v-model="age" placeholder="Age">
                </div>
                <div class="form-group">
                    <label for="weight" class="sr-only">Weight</label>
                    <input id="weight" class="form-control col" type="weight" v-model="weight" placeholder="Weight">
                </div>

                <button class="btn btn-primary btn-block" @click="addInfo()">Register</button>
            </div>
        </div>
    </div>
</template>

<script>

</script>

<style scoped>

</style>