<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <router-link to="/" class="navbar-brand">Blood Donations</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav mr-auto">
                    <li v-for="link in links" class="nav-item">
                        <router-link :to="link.path" class="nav-link">{{ link.name }}</router-link>
                    </li>
                </ul>
                <user-controls />
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            links() {
                return this.$store.getters.links;
            }
        },
    }
</script>