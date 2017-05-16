<template>
    <div class="container is-fluid">
        <h2 class="title is-2">{{ factory.name }}</h2>
        <div class="box">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column is-one-quarter">
                        IMAGES
                    </div>
                    <div class="column is-three-quarters">

                        <select-product></select-product>

                        <modificators></modificators>

                        <add-to-cart></add-to-cart>

                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<style></style>

<script>

    import SelectProduct from './Modificators/SelectProduct.vue';
    import Modificators from './Modificators/Modificators.vue';
    import AddToCart from './AddToCart.vue';
    export default {
        props: ['factory'],
        data(){
            return {
            }
        },
        methods: {

        },
        computed: {
            products(){
                return this.factory.products;
            },
            product(){
                return this.$store.state.f.product;
            }
        },
        watch:{
        },
        mounted() {

            this.$store.commit('setFactory', this.factory);

        },
        components: {
            Modificators,
            SelectProduct,
            AddToCart
        }
    }
</script>
