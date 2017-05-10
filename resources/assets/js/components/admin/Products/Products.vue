<template>
    <div>
        <h2 class="title is-2">
            Products
        </h2>


        <product-list  :products="products" ></product-list>

    </div>
</template>

<style></style>

<script>

    import ProductList from './_productList.vue';
    export default {
        props: ['products'],
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
            ProductList,
        }
    }
</script>
