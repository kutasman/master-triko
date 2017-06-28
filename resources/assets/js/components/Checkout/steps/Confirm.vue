<template>
    <div class="box">
        <!--Contacts-->
        <div class="media" v-show="checkout.steps.isPassed('contacts')">
            <div class="media-content">
                Contacts: {{ checkout.contacts.first_name }}
            </div>
        </div>
        <!--Shipping-->
        <div class="media" v-show="checkout.steps.isPassed('shipping')">
            <div class="media-content">
                Shipping: {{ checkout.shipping.selected.name }}
            </div>
        </div>
        <!--Payment-->
        <div class="media" v-show="checkout.steps.isPassed('payment')">
            <div class="media-content">
                Payment: {{ checkout.payment.selected.name }}
            </div>
        </div>

        <div class="field">
            <label class="label"></label>
            <div class="control">

                <button v-show="checkout.steps.is('confirm')"

                        @click.prevent="checkout.createOrder()"
                        class="button is-large is-success">Confirm order!</button>
            </div>
        </div>



    </div>
</template>

<style></style>

<script>

    export default {
        props: ['checkout'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
