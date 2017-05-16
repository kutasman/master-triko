<template>
    <div>
        <component v-for="mod in modificators" :is="mod.type + 'Mod'" :mod="mod"></component>
    </div>
</template>

<style></style>

<script>
    import TextModificator from './_textMod.vue'
    import SelectModificator from './_selectMod.vue';
    export default {
        props: [],
        data(){
            return {}
        },
        methods: {},
        computed: {
            modificators(){
                return this.$store.state.f.product.modificators;
            }
        },
        mounted() {
        },
        components: {
            'textMod': TextModificator,
            'selectMod': SelectModificator,
        }
    }
</script>
