<template>
    <div class="box">
        <h5 class="title is-5">
            Payment
            <span v-show="checkout.steps.isPassed('payment')"
                  class="button is-pulled-right"
                  @click="checkout.steps.set('payment')">edit</span>
        </h5>

        <div class="columns" v-show="checkout.steps.is('payment')">
            <div class="column is-4">
                <div class="field">
                    <label class="label">Select payment type</label>
                    <div class="control">
                        <div class="select" :class="{'is-warning': checkout.validator.hasError('payment_type')}">
                            <select v-model="checkout.payment.selected">
                                <option v-for="payment in checkout.payment.payments" :value="payment" v-text="payment.name"></option>
                            </select>
                        </div>
                        <p class="help is-danger" v-show="checkout.validator.hasError('payment_type')" v-text="checkout.validator.showError('payment_type')"></p>

                    </div>
                </div>
            </div>
            <div class="column is-8">
                <p>
                    {{ checkout.payment.selected.description }}
                </p>
            </div>

        </div>

        <div class="field" v-show="checkout.steps.is('payment')">
            <label class="label"></label>
            <div class="control">
                <div class="button is-success" @click="checkout.validate()">Next</div>
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
