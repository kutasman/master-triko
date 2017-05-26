<template>
    <div class="field">
        <label class="label" v-text="mod.name"></label>
        <p class="control">
            <label v-for="option in mod.options" class="radio">
                <input type="radio" :name="mod.name" :value="option.id" v-model="value" :disabled="disabled">
                {{ option.name }}
            </label>

        </p>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['mod'],
        data(){
            return {
                value: ''
            }
        },
        methods: {},
        watch: {
            value(){
                this.$store.commit('syncModificator', {
                    id: this.mod.id,
                    value: this.value
                });
            }
        },
        computed: {
            disabled(){
                return this.$store.getters.isDisabled(this.mod.id);
            }
        },
        mounted() {
        },
        components: {}
    }
</script>
