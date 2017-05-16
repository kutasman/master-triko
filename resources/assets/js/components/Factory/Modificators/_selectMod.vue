<template>
    <div class="field">
        <label class="label" v-text="mod.name"></label>
        <p class="control">
            <span class="select">
              <select v-model="value">
                  <option disabled value="">Select option</option>
                  <option v-for="o in mod.options" :value="o.id" v-text="o.name"></option>
              </select>
            </span>
        </p>
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
                    value: this.value,
                })
            }
        },
        mounted() {
        },
        components: {}
    }
</script>
