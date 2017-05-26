<template>
    <div class="field">
        <label class="label" v-text="mod.name"></label>
        <div class="control">
            <input type="text" class="input" v-model="value" :disabled="disabled"/>
        </div>
    </div>
</template>

<style></style>

<script>


    export default {
        props: ['mod'],
        data(){
            return {
                value:'',
            }
        },
        methods: {

        },
        computed: {
            rules(){
                return this.$store.state.f.product.mod_rules;
            },
            modificators(){
                return this.$store.state.f.modificators;
            },
            disabled(){
                return this.$store.getters.isDisabled(this.mod.id);
            }

        },
        watch:{
            value(){
                this.$store.commit('syncModificator', {
                    id: this.mod.id,
                    value: this.value
                });
            }
        },
        mounted() {
        },
        components: {

        }
    }
</script>
