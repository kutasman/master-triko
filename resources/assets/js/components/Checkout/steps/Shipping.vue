<template>
    <div class="box">
        <h5 class="title is-5">
            Shipping
            <span v-show="checkout.steps.isPassed('shipping')" class="button is-pulled-right" @click="checkout.steps.set('shipping')">edit</span>

        </h5>

        <div class="columns" v-show="checkout.steps.is('shipping')">

                <div class="column is-4">
                    <div class="field">
                        <label class="label">Select shipping type</label>
                        <div class="control">
                            <div class="select">
                                <select v-model="checkout.shipping.selected">
                                    <option v-for="shipping in checkout.shipping.shippings" :value="shipping" v-text="shipping.name"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="column is-8">
                <p>
                    {{ checkout.shipping.selected.description }}
                </p>
                <component :is="checkout.shipping.selected.slug" :shipping="checkout.shipping.selected" :checkout="checkout"></component>

            </div>

        </div>

        <div class="field" v-show="checkout.steps.is('shipping')">
            <label class="label"></label>
            <div class="control">
                <div class="button is-success" @click="checkout.validate()">Next</div>
            </div>
        </div>

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
