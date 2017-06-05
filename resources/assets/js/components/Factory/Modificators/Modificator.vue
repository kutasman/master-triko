<template>
    <div class="field">

        <label class="label" v-text="mod.name"></label>

        <!--text type-->
        <div v-if="mod.type === 'text'" class="control">
            <input type="text" class="input" v-model="value" :disabled="disabled"/>
        </div>

        <!--select type-->
        <div v-else-if="mod.type === 'select'" class="control">
            <span class="select">
              <select v-model="value" :disabled="disabled">
                  <option disabled value="">Select option</option>
                  <option v-for="o in mod.options" :value="o.id" v-text="o.name"></option>
              </select>
            </span>
        </div>

        <!--radio type-->
        <div v-else-if="mod.type === 'radio'" class="control">
            <label v-for="option in mod.options" class="radio">
                <input type="radio" :name="mod.name" :value="option.id" v-model="value" :disabled="disabled">
                {{ option.name }}
            </label>
        </div>

    </div>
</template>

<style></style>

<script>
    export default {
        props: ['mod'],
        data(){
            return {
                value: null
            }
        },
        methods: {
            setDefaultValue(){
                let defaultOptions =  this.getDefaultOption();

                if ( !_.isEmpty(defaultOptions)){
                    this.value = defaultOptions.id;
                }
            },
            getDefaultOption(){
                return _.first(this.mod.options.filter(option => {
                    return option.default === true;
                }));
            }
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
        watch: {
            value(){
                this.$store.commit('syncModificator', {
                    mod: this.mod,
                    value: this.value
                });
            }
        },
        mounted() {
            this.setDefaultValue();
        },
        components: {

        }
    }
</script>
