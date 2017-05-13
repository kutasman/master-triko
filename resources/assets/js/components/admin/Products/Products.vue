<template>
    <div>
        <div class="columns">
            <div class="column">
                <h2 class="title is-2">
                    Products
                </h2>


                <div class="media" v-for="product in products">
                    <div class="media-left">
                        <img src=""/>
                    </div>
                    <div class="media-content">
                        <p>
                            <strong><a @click="editProduct(product)" >{{ product.title }}</a></strong>

                        </p>
                    </div>
                    <div class="media-right">
                        <div class="field">
                            <div class="button is-small is-danger" @click="deleteProduct(product)">delete</div>
                            <div class="button is-small is-warning" @click="editProduct(product)">edit</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                Create product

                <create-product :products="products" :factories="factories"></create-product>
            </div>
        </div>
    </div>
</template>

<style></style>

<script>

    import CreateProduct from './CreateProduct.vue';
    export default {
        props: ['productsInit', 'factories'],
        data(){
            return {
                products: [],
            }
        },
        methods: {
            editProduct(product){
                window.location.href = 'products/'+product.id + '/edit';
            },
            deleteProduct(deleted){
                axios.delete('/admin/products/' + deleted.id)
                    .then(response => {
                        this.products = this.products.filter(prod => {
                            return prod.id !== deleted.id;
                        });
                    });

            }
        },
        computed: {

        },
        mounted() {
            this.products = this.productsInit;
        },
        components: {
            CreateProduct
        }
    }
</script>
