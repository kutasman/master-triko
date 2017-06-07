<template>
    <div class="box">
        <h5 class="title is-5">Shipping</h5>

        <!--<component :is="userShipping.type" :meta="userShipping.meta" :shipping="shipping" @shipping-ready="shippingReadyEvent"></component>-->


    </div>
</template>

<style></style>

<script>
    import NovaPoshta from '../shippings/NovaPoshta.vue'

    export default {
        props: [],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
        },
        components: {
            NovaPoshta,
        }
    }
</script>
