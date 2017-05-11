<template>
        <div class="field has-addons has-addons-centered">
            <p class="control">
                <input name="modificator_name" v-model="newMod.name" class="input" type="text" placeholder="Modificator name">
            </p>
            <p class="control">
                <span class="select">
                  <select v-model="newMod.type">
                    <option v-for="type in types" v-text="type"></option>
                  </select>
                </span>
            </p>
            <p class="control">
                <a @click="createModificator" class="button is-primary">
                    Create
                </a>
            </p>
        </div>
</template>

<style></style>

<script>

    export default {
        props: ['modificators'],
        data(){
            return {
                types: ['text', 'select'],
                newMod:{
                    name:'',
                    type: 'text',
                }
            }
        },
        methods: {
            createModificator(){
                this.$emit('create-modificator', this.newMod);
                this.newMod = {name:'',type: 'text'};
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
