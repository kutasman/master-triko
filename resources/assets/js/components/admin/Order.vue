<template>
<div>
    <li class="list-group-item">
        <strong>ID: {{ order.id }}</strong>,

        {{ order.first_name }}, {{ order.email }}, {{ order.phone }}, {{ order.comment }}
        <span class="text-success" v-for="status in order.statuses" v-text="status.name"></span>


    </li>

</div>
</template>

<style></style>

<script>
    export default {
        props: ['order'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
            console.log('cart component mounted');
            console.dir(this.order);
        }
    }
</script>
