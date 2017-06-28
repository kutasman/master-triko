<template>
    <div class="box">
        <h5 class="title is-5">
            Contacts
            <span v-show="checkout.steps.isPassed('contacts')" class="button is-pulled-right" @click="checkout.steps.set('contacts')">edit</span>
        </h5>

        <div v-show="checkout.steps.is('contacts')">
            <div class="field">
                <label class="label">First Name</label>
                <div class="control">
                    <input :class="{'is-danger': validator.hasError('first_name')}"  class="input" title="First Name" type="text" name="first_name" v-model="checkout.contacts.first_name"/>
                    <span class="help is-danger" v-show="validator.hasError('first_name')" >{{ validator.showError('first_name') }}</span>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input :class="{'is-danger': validator.hasError('email')}"  class="input" title="Email" type="email" name="email" v-model="checkout.contacts.email"/>
                    <span class="help is-danger" v-show="validator.hasError('email')" >{{ validator.showError('email') }}</span>

                </div>
            </div>

            <div class="field">
                <label class="label">Phone</label>
                <div class="control">
                    <input :class="{'is-danger': validator.hasError('phone')}"  type="text" title="Phone" class="input" name="phone" v-model="checkout.contacts.phone"/>
                    <span class="help is-danger" v-show="validator.hasError('phone')" >{{ validator.showError('phone') }}</span>

                </div>
            </div>

            <div class="field">
                <label class="label"></label>
                <div class="control">
                    <div class="button is-success" @click="checkout.validate()">Next</div>
                </div>
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
        methods: {
        },
        computed: {
            validator(){
                return this.checkout.validator;
            }
        },
        mounted() {
        },
        components: {}
    }
</script>
