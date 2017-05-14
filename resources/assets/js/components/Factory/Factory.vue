<template>
    <div class="ui container">
        <h2 class="ui header">  {{ factory.name }}</h2>
        <div class="ui grid">
            <div class="four wide column">
                IMAGE
            </div>
            <div class="nine wide column">

                <div class="ui form">

                    <div class="field">
                        <label>Product</label>
                        <select class="ui fluid dropdown" id="product">
                            <option v-for="product in factory.products" :value="product" v-text="product.title"></option>
                        </select>
                    </div>



                </div>

            </div>

        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['factory'],
        data(){
            return {
                product: {}
            }
        },
        methods: {},
        computed: {},
        watch:{
        },
        mounted() {
            this.product = _.first(this.factory.products);

            $('.ui.dropdown').dropdown();
        },
        components: {}
    }
</script>
