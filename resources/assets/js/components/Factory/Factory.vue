<template>
    <div class="container is-fluid">
        <h2 class="title is-2">{{ factory.name }}</h2>
        <div class="box">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column is-5">
                        <showcase></showcase>
                    </div>
                    <div class="column is-7">

                        <select-product></select-product>

                        <modificators></modificators>

                        <add-to-cart></add-to-cart>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <tabs></tabs>
                    </div>
                    <div class="column">
                        TESTIMONIALS
                    </div>
                </div>

            </div>
        </div>
    </div>


</template>

<style></style>

<script>

    import SelectProduct from './Modificators/SelectProduct.vue';
    import Showcase from './Showcase.vue';
    import Modificators from './Modificators/Modificators.vue';
    import AddToCart from './AddToCart.vue';
    import Tabs from './Tabs/Tabs.vue';
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
            AddToCart,
            Tabs,
            Showcase
        }
    }
</script>
