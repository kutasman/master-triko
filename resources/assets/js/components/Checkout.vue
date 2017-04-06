<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Checkout</h3>
        </div>
        <div class="panel-body">
            {{ hello }}
            <button v-on:click="getCart">get Cart</button>
        </div>
    </div>
</template>

<style></style>

<script>
    export default {
        data(){
            return {
                hello: 'Hello from vue',
            }
        },
        methods: {
             getCart (){
                jQuery.get('http://master-trico.app/api/checkout/cart', function (data) {
                    console.log(data);
                })
             }
        }
    }
</script>
