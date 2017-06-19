<template>
    <div class="box">
        <h5 class="title is-5">Shipping</h5>

        <div class="columns">


            <div class="field">
                <p class="control">
                    <label class="radio" v-for="shipping in checkout.shippings">
                        <input type="radio" name="shipping" v-model="selectedShipping" :value="shipping">
                        {{ shipping.name }}
                    </label>
                </p>
            </div>
        </div>


        <component :is="selectedShipping.slug" :meta="selectedShipping.meta" :shipping="selectedShipping" @shipping-ready="shippingReadyEvent"></component>


    </div>
</template>

<style></style>

<script>
    import NovaPoshta from '../shippings/NovaPoshta.vue'

    export default {
        props: ['checkout'],
        data(){
            return {
                selectedShipping: ''
            }
        },
        methods: {
            selectShipping(shipping){
                this.selectedShipping = shipping;
            },
            shippingReadyEvent(){

            }
        },
        computed: {},
        mounted() {
        },
        components: {
            nova_poshta: NovaPoshta,
        }
    }
</script>
