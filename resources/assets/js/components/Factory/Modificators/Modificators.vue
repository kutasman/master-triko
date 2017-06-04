<template>
    <div>


        <modificator v-for="mod in modificators" :mod="mod"></modificator>
    </div>
</template>

<style></style>

<script>

    import Modificator from './Modificator.vue';

    export default {
        props: [],
        data(){
            return {
            }
        },
        methods: {},
        computed: {
            modificators(){
                return this.$store.state.f.product.modificators;
            },
            rules(){
                return this.$store.state.f.product.mod_rules;
            }
        },
        mounted() {
        },
        components: {

            Modificator,
        }
    }
</script>
