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
                axios.put('/cart', this.$store.state.f)
                    .then(res => {
                        console.log(res.data);
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
