<template>
    <div class="field">
        <label class="label"></label>
        <a @click="addToCart" class="button is-success">
            <span class="icon">
                <i class="fa fa-cart-arrow-down"></i>
            </span>
            <span>Add to cart</span>
        </a>

    </div>
</template>

<style></style>

<script>

    export default {
        props: [],
        data(){
            return {}
        },
        methods: {
            addToCart(){
                console.log('add to cart');
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
