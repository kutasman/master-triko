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
                                    <button @click.prevent="toContacts" v-if="!isContactsStep" class="btn btn-xs btn-warning pull-right">edit</button>
                                </h3>
                            </div>
                            <div v-if="isContactsStep" class="panel-body">
                                <div class="form-group">
                                    <label for="firstName" >First name</label>
                                    <input v-model="customer.firstName" type="text" class="form-control" name="firstName" id="firstName" placeholder="Name..." required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="customer.email" type="text" class="form-control" name="email" id="email" placeholder="Email..." required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input v-model="customer.phone" type="tel" class="form-control" name="email" id="phone" placeholder="Phone..." required>
                                </div>


                                <button @click.prevent="toShipping" type="submit" class="btn btn-primary btn-block">Next step</button>


                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Shipping</h3>
                            </div>
                            <div v-if="isShippingStep" class="panel-body">
                                shipping


                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                      </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                    firstName : '',
                    email : '',
                    phone : '',
                },
                step: 'contacts',
                shippings: [
                    'nova_poshta'
                ]

            }
        },
        methods: {
            toShipping(){
                this.step = 'shipping';
              console.log('go to shipping');
            },
            toContacts(){
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
            }
        },
        mounted() {
            console.log('mounted');
            this.cartSession = $('#checkout-container').data('cart');

            let self = this;

            axios.get('api/checkout/cart/' + this.cartSession)
                .then(function (response) {
                    self.cart = response.data.cart;
                })
                .catch(function (error) {
                    console.log(error);
                });

        }
    }
</script>
