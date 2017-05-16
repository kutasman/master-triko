<template>
    <div class="field">
        <label class="label" v-text="mod.name"></label>
        <div class="control">
            <input type="text" class="input" v-model="value"/>
        </div>
    </div>
</template>

<style></style>

<script>


    export default {
        props: ['mod'],
        data(){
            return {
                value:''
            }
        },
        methods: {},
        computed: {},
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
