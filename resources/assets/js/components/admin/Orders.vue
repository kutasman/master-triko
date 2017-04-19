<template>

    <ul class="list-group">
        <order v-for="order in orders" :order="order"></order>
    </ul>

</template>

<style></style>

<script>
    export default {
        props: ['orders'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {

        },
        components:{
            order: require('./Order.vue'),
        }
    }
</script>
