<template>
    <modal name="example"
           :width="300"
           :height="300";
           max-height:100%;
           @before-open="beforeOpen"
           @before-close="beforeClose">
        <b>{{time}}</b>
    </modal>
</template>
<script>
    export default {
        name: 'ExampleModal',
        data () {
            return {
                time: 0,
                duration: 5000
            }
        },
        methods: {
            beforeOpen (event) {
                console.log(event)
                // Set the opening time of the modal
                this.time = Date.now()
            },
            beforeClose (event) {
                console.log(event)
                // If modal was open less then 5000 ms - prevent closing it
                if (this.time + this.duration < Date.now()) {
                    event.stop()
                }
            }
        },
        mounted() {
            this.$modal.show("example")
        }
    }
</script>