<template>
    <div>
        {{ description }}
    </div>
</template>

<style></style>

<script>

    export default {
        props: [],
        data(){
            return {}
        },
        methods: {},
        computed: {
            description(){
                return this.$store.state.f.product.description;
            }
        },
        mounted() {
        },
        components: {}
    }
</script>
