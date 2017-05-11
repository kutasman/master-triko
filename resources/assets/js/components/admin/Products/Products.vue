<template>
    <div>
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
                    <div class="button is-small is-danger">delete</div>
                    <div class="button is-small is-warning" @click="editProduct(product)">edit</div>
                </div>
            </div>
        </div>

    </div>
</template>

<style></style>

<script>

    export default {
        props: ['products'],
        data(){
            return {
            }
        },
        methods: {
            editProduct(product){
                window.location.href = 'products/'+product.id + '/edit';
            }
        },
        computed: {

        },
        mounted() {
        },
        components: {
        }
    }
</script>
