<template>
    <div>
        <header class="masthead text-white d-flex flex-column justify-content-center text-center">
            <h1 class="text-uppercase">
                <strong>In Romania, only 1.7% of the adult population is donating blood.</strong>
            </h1>
            <hr>
            <p class="text-faded">You can change that.</p>
        </header>
    </div>
</template>

<script>
    export default {}
</script>

<style scoped>
    header.masthead {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background: url("landingPage.jpg") center center;
        background-size: cover;
    }

    @media (min-width: 992px) {
        header.masthead {
            height: 100vh;
            min-height: 650px;
            padding-top: 0;
            padding-bottom: 0;
        }

        header.masthead h1 {
            font-size: 3rem;
        }
    }

    body {
        font-family: 'Merriweather', 'Helvetica Neue', Arial, sans-serif;
    }
</style>