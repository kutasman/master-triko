<template>
    <div></div>
</template>

<style></style>

<script>

    export default {
        props: ['meta', 'shipping'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
            this.$emit('shipping-ready');
        },
        components: {}
    }
</script>
