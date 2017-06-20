<template>
    <div v-if="! steps.is('finish')">
        <h3 class="title is-3">Checkout</h3>

        <div class="columns">
            <div class="column is-8">

                <contacts :checkout="checkout"></contacts>

                <shipping :checkout="checkout"></shipping>

                <payment></payment>

            </div>
            <!--<div class="column is-4">
                    <div class=" well well-sm">
                        <h3>Summary</h3>

                        <p v-if="canEdit('contacts')">
                            <strong>Contacts:</strong>
                            {{ customer }}
                        </p>
                        <p v-if="canEdit('shipping')">
                            <strong>Shipping:</strong>
                            {{ userShipping.type }}
                                {{ userShipping.meta.city.DescriptionRu }} {{ userShipping.meta.warehouse.DescriptionRu }}
                        </p>
                        <p v-if="canEdit('payment')">
                            <strong>Payment:</strong>
                            {{ userPayment }}
                        </p>
                        <p>
                            <strong>Products:</strong>
                            <ul>
                                <li v-for="item in cart.items">
                                    {{ item.data.title }}, {{ item.total }}
                                </li>
                            </ul>
                        </p>

                        <p>
                            total: {{ cartTotal }}
                        </p>
                    </div>
                    <button v-if="steps.is('confirm')" @click.prevent="createOrder" class="btn btn-block btn-lg btn-success">Confirm order! <span class="badge">{{ cartTotal }} грн.</span></button>
                </div>-->
        </div>

    </div> <!--.panel-default-->
    <div v-else class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Success</h3>
        </div>
        <div class="panel-body">
            <h1>Your order number is <strong>{{ order_id }}</strong></h1>

        </div>
    </div>
</template>

<style></style>

<script>

    import Checkout from '../../helpers/Checkout/Checkout';

    import Contacts from './steps/Contacts.vue';
    import Shipping from './steps/Shipping.vue';
    import Payment from './steps/Payment.vue';

    export default {
        props: ['shippings', 'payments', 'cart'],
        data(){
            return {
                checkout: new Checkout(this.shippings, this.payments, this.cart),
            }
        },
        methods: {
            /*validateContacts(){
                axios.post('checkout/validate/contacts', this.customer)
                    .then((response) => {
                        if (200 === response.status){
                            this.toShipping();
                        }

                    })
                    .catch((error) => {
                        this.contactsErrors = error.response.data;
                        console.log(error.response.data)
                    });
            },
            validateShipping(){

                axios.post('checkout/validate/shipping', this.userShipping)
                    .then((response) => {
                        if (200 == response.status){
                            this.toPayment();
                        }

                        })
                    .catch((error) => {
                        console.log(error);
                        });
            },
            validatePayment(){
                axios.post('checkout/validate/payment', this.userPayment)
                    .then((response) => {
                        if (200 == response.status){
                            this.toConfirm();
                        }
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                    });
            },*/
            createOrder(){

              axios.post('checkout/confirm-order', {
                  cart_id: this.cart.id,
                  first_name: this.customer.first_name,
                  email: this.customer.email,
                  phone: this.customer.phone,
                  shipping: this.userShipping,
                  payment: this.userPayment,
              }).then((response) => {
                    if (200 == response.status){
                        this.order_id = response.data;
                        this.finish();
                    }
              }).catch((error) => {
                  console.log(error.response.data);
              })
            },
            finish(){
                console.log('ura!');
                this.step = 'finish';

            },
            shippingReadyEvent(){
                console.log('shipping ready');
            },

        },
        computed: {
            steps(){
                return this.checkout.steps;
            },
            cartTotal(){
                return this.cart.total;
            },

        },
        watch: {
        },
        mounted() {
        },
        components: {
            Contacts,
            Shipping,
            Payment,
        }
    }
</script>
