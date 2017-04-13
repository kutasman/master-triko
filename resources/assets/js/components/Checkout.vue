<template xmlns="http://www.w3.org/1999/html">
    <div v-if="step != 'finish' " class="panel panel-default">
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
                                    <button @click.prevent="toContacts" v-if="canEdit('contacts')" class="btn btn-xs btn-warning pull-right">edit</button>
                                </h3>
                            </div>
                            <div v-if="isStep('contacts')" class="panel-body">
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
                                <h3 class="panel-title">Shipping
                                <button @click.prevent="toShipping" v-if="canEdit('shipping')" class="btn btn-warning btn-xs pull-right">edit</button>
                            </h3>
                            </div>
                            <div v-if="isStep('shipping')" class="panel-body">
                                <div class="list-group">
                                    <div v-for="(shipping, index) in shippings">
                                        <a @click.prevent="chooseShipping(index)" href="#" :class="{active: userShipping.type == shipping.slug}" class="list-group-item">
                                            <h4 class="list-group-item-heading">{{ shipping.name }}</h4>
                                            <p class="list-group-item-text">{{ shipping.description }}</p>
                                        </a>
                                    </div>

                                    <div v-if="userShipping.type == 'nova_poshta'">
                                        <input v-model="userShipping.meta" />
                                    </div>


                                </div>

                                <button @click.prevent="validateShipping" class="btn btn-success pull-right">Next step</button>


                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payment
                                    <button v-if="canEdit('payment')" @click.prevent="toPayment" class="btn btn-warning btn-xs pull-right">edit</button>
                                </h3>
                            </div>
                            <div v-if="isStep('payment')" class="panel-body">
                                <div class="list-group">

                                <div v-for="(payment, index) in payments">
                                    <a @click.prevent="choosePayment(payment.slug)" href="#" :class="{active: userPayment.type == payment.slug }" class="list-group-item ">
                                        <h4 class="list-group-item-heading">{{ payment.name }}</h4>
                                        <p class="list-group-item-text">Content goes here</p>
                                    </a>
                                </div>
                                </div>

                                <button v-if="userPayment.type" @click.prevent="validatePayment" class="btn btn-block btn-success">Next step</button>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class=" well well-sm">
                        <h3>Summary</h3>

                        <p v-if="canEdit('contacts')">
                            <strong>Contacts:</strong>
                            {{ customer }}
                        </p>
                        <p v-if="canEdit('shipping')">
                            <strong>Shipping:</strong>
                            {{ userShipping }}
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
                    <button v-if="isStep('confirm')" @click.prevent="createOrder" class="btn btn-block btn-lg btn-success">Confirm order! <span class="badge">{{ cartTotal }} грн.</span></button>
                </div>
            </div>
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
    export default {
        data(){
            return {
                cart: {},
                cartSession: '',
                order_id: '',
                customer: {
                    first_name : '',
                    email : '',
                    phone : '',
                },
                step: 'contacts',
                steps: [
                    'contacts', 'shipping', 'payment', 'confirm', 'success'
                ],
                validated: [],
                shippings: {},
                payments: {},
                userShipping: {
                    type_id: '',
                    type: '',
                    meta: '',
                },
                userPayment:{
                    type: ''
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
            },
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
                        console.log(response.data);
                        this.order_id = response.data;
                        this.finish();
                    }
              }).catch((error) => {
                  console.log(error.response.data);
              })
            },
            isStep(step){
                return step == this.step;
            },
            canEdit(step){
                console.log(this.steps.indexOf(step) < this.steps.indexOf(this.step) );
                return this.steps.indexOf(step) < this.steps.indexOf(this.step);
            },
            toContacts(){
              this.step = 'contacts';
            },
            toShipping(){
                this.step = 'shipping';
              console.log('go to shipping');
            },
            toPayment(){
                this.step = 'payment';
            },
            toConfirm(){
              this.step = 'confirm';
            },
            toSuccess()
            {
              this.step = 'success';
            },
            chooseShipping(index){
                this.userShipping.type = this.shippings[index].slug;
                this.userShipping.type_id = this.shippings[index].id;
            },
            choosePayment(slug){
                this.userPayment.type = slug;
            },
            finish(){
                console.log('ura!');
                this.step = 'finish';

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
        },
        mounted() {
            console.log('mounted');
            this.cartSession = $('#checkout-container').data('cart');
            console.log(this.canEdit('payment'));
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
