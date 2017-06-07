<template>
    <div class="box">
        <h5 class="title is-5">Contacts</h5>

        <div class="field">
            <label class="label">First Name</label>
            <div class="control">
                <input class="input" title="First Name" type="text" name="first_name" v-model="checkout.customer.first_name"/>
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" title="Email" type="email" name="email" v-model="checkout.customer.email"/>
            </div>
        </div>

        <div class="field">
            <label class="label">Phone</label>
            <div class="control">
                <input type="text" title="Phone" class="input" name="phone" v-model="checkout.customer.phone"/>
            </div>
        </div>

        <div class="field">
            <label class="label"></label>
            <div class="control">
                <div class="button is-success" @click="checkout.nextStep('shipping')">Next</div>
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
