<template>
    <div>
        <header class="masthead text-center text-white d-flex">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <h1 class="text-uppercase">
                            <strong>In Romania, only 1.7% of the adult population is donating blood.</strong>
                        </h1>
                        <hr>
                    </div>
                    <div class="col-lg-8 mx-auto">
                        <p class="text-faded mb-5">You can change that.</p>
                        <!-- <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a> -->
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>

    header.masthead {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 56px);
        background-image: url("landingPage.jpg");
        background-position: center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
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

    body,
    html {
        width: 100%;
        height: 100%;
    }

    body {
        font-family: 'Merriweather', 'Helvetica Neue', Arial, sans-serif;
    }
</style>