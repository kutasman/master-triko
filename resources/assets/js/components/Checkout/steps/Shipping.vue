<template>
    <div class="box">
        <h5 class="title is-5">Shipping</h5>

        <div class="columns">


            <div class="field">
                <p class="control">
                    <label class="radio" v-for="shipping in checkout.shipping.shippings">
                        <input type="radio" name="shipping" v-model="checkout.shipping.selected" :value="shipping">
                        {{ shipping.name }}
                    </label>
                </p>
            </div>
        </div>


        <component :is="checkout.shipping.selected.slug" :shipping="checkout.shipping.selected" :checkout="checkout"></component>




    </div>
</template>

<style></style>

<script>
    import NovaPoshta from '../shippings/NovaPoshta.vue'
    import Curier from '../shippings/Curier.vue';

    export default {
        props: ['checkout'],
        data(){
            return {
            }
        },
        methods: {

        },
        computed: {
        },
        mounted() {
        },
        components: {
            nova_poshta: NovaPoshta,
            curier: Curier,
        }
    }
</script>
