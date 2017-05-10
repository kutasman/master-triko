<template>
    <div>
        <div class="media" v-for="product in products">
            <div class="media-left">
                <img src=""/>
            </div>
            <div class="media-content">
                <p>
                    <strong>{{ product.title }}</strong>

                </p>
            </div>
            <div class="media-right">
                <div class="field">
                    <div class="button is-small">delete</div>
                    <div class="button is-small" @click="editProduct(product)">edit</div>
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
            return {}
        },
        methods: {
            editProduct(product){
                window.location.href = 'products/'+product.id;
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
