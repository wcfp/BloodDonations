<template>
    <div class="col-xs-12 col-sm-8 offset-sm-2">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="invite()">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" class="form-control col" type="email" v-model="email" placeholder="Email"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="user_type" class="sr-only">User type</label>
                        <select id="user_type" class="custom-select" v-model="userType" required>
                            <option value="" selected>Select user type</option>
                            <option value="ASSISTANT">Medical staff</option>
                            <option value="DOCTOR">Doctor</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Invite">
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
            }
        },
        methods: {
            invite() {
                axios.post('/api/admin/invite', {email: this.email, role: this.userType});
            }
        }
    }
</script>
