<template xmlns="http://www.w3.org/1999/html">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Checkout</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-8">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contacts
                                    <button @click.prevent="editContacts" v-if="!isContactsStep" class="btn btn-xs btn-warning pull-right">edit</button>
                                </h3>
                            </div>
                            <div v-if="isContactsStep" class="panel-body">
                                <form action="checkout/validate/contacts" method="post">
                                <div class="form-group">
                                    <label for="firstName" >First name</label>
                                    <input v-model="customer.first_name" type="text" class="form-control" name="firstName" id="firstName" placeholder="Name..." required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="customer.email" type="text" class="form-control" name="email" id="email" placeholder="Email..." required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input v-model="customer.phone" type="tel" class="form-control" name="email" id="phone" placeholder="Phone..." required>
                                </div>


                                <button @click.prevent="validateContacts" type="submit" class="btn btn-primary btn-block">Next step</button>

                                </form>

                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Shipping</h3>
                            </div>
                            <div v-if="isShippingStep" class="panel-body">
                                <div class="list-group">
                                    <div v-for="(shipping, index) in shippings">
                                        <a @click.prevent="chooseShipping(shipping.slug)" href="#" class="list-group-item">
                                            <h4 class="list-group-item-heading">{{ shipping.name }}</h4>
                                            <p class="list-group-item-text">{{ shipping.description }}</p>
                                        </a>
                                    </div>

                                    <div v-if="shipping.type == 'nova_poshta'">
                                        <input v-model="shipping.data" />
                                    </div>


                                </div>

                                <button @click.prevent="validateShipping" class="btn btn-success pull-right">Next step</button>


                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payment</h3>
                            </div>
                            <div v-if="isPaymentStep" class="panel-body">
                                <div class="list-group">

                                <div v-for="(payment, index) in paymets">
                                    <a href="#" class="list-group-item ">
                                        <h4 class="list-group-item-heading">Item heading</h4>
                                        <p class="list-group-item-text">Content goes here</p>
                                    </a>
                                </div>
                                </div>


                            </div>
                        </div>

                        

                    </div>

                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class=" well well-sm">
                        <h3>Summary</h3>
                        <p>{{ customer }}</p>
                        <p>
                            <ul>
                                <li v-for="item in cart.items">
                                    {{ item.data.title }}, {{ item.total }}
                                </li>
                            </ul>
                        </p>
                        total: {{ cartTotal }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style></style>

<script>
    export default {
        data(){
            return {
                cart: {},
                cartSession: '',
                customer: {
                    first_name : '',
                    email : '',
                    phone : '',
                },
                step: 'contacts',
                shippings: {},
                payments: {},
                shipping: {
                    type: '',
                    data: '',
                },
                contactsErrors: [],
                shippingErrors: [],

            }
        },
        methods: {
            validateContacts(){
                console.log('validate contacts');
                axios.post('checkout/validate/contacts', this.customer)
                    .then((response) => {
                        if (200 == response.status){
                            console.log('ke!');
                            this.toShipping();
                        }

                    })
                    .catch((error) => {
                        this.contactsErrors = error.response.data;
                        console.log(error.response.data)
                    });
            },
            validateShipping(){
                console.log('validate shipping');

                axios.post('checkout/validate/shipping', this.shipping)
                    .then((response) => {
                        if (200 == response.status){
                            this.toPayment();
                        }

                        })
                    .catch((error) => {
                        console.log(error);
                        });
            },
            toShipping(){
                this.step = 'shipping';
              console.log('go to shipping');
            },
            toPayment(){
                this.step = 'payment';
            },
            chooseShipping(slug){
                console.log(slug);
                this.shipping.type = slug;
            },
            editContacts(){
                this.step = 'contacts';
            }
        },
        computed: {
            cartTotal(){
                return this.cart.total;
            },
            isContactsStep(){
                return this.step == 'contacts';
            },
            isShippingStep(){
                return this.step == 'shipping';
            },
            isPaymentStep(){
                return this.step == 'payment';
            }
        },
        watch: {
            shipping: function(){
                console.log(this.shipping.type);
            }
        },
        mounted() {
            console.log('mounted');
            this.cartSession = $('#checkout-container').data('cart');

            axios.get('api/checkout/cart/' + this.cartSession)
                .then((response) =>  {
                    console.log(response.data.shippings);
                    this.cart = response.data.cart;
                    this.shippings = response.data.shippings;
                    this.payments = response.data.payments;
                })
                .catch(function (error) {
                    console.log(error);
                });

        }
    }
</script>
