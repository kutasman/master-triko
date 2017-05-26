<template>
    <div class="box">

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">New rule</label>
            </div>
            <div class="field-body">

                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                            <select @change="getOptions" v-model="newRule.toggle_id">
                                <option value="" disabled>select toggle</option>
                                <option v-for="mod in toggles" :value="mod.id" v-text="mod.name"></option>
                            </select>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.toggle_option_id">
                                <option value="" disabled>select toggle option</option>
                                <option v-for="option in toggle_options" v-text="option.name" :value="option.id"></option>
                          </select>
                        </span>
                    </div>
                </div>


                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.target_id">
                                <option value="" disabled>select target</option>
                                <option v-for="target in targets" v-text="target.name" :value="target.id"></option>
                          </select>
                        </span>
                    </div>
                </div>


                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.action">
                                <option value="" disabled>select status</option>
                                <option v-for="action in actions" v-text="action" :value="action"></option>
                          </select>
                        </span>
                    </div>
                </div>


                <div class="field">
                    <div class="control">
                        <span @click="createRule" class="button is-small">add</span>
                    </div>
                </div>


            </div>
        </div>

        <mod-rule @delete-rule="deleteRule(rule)"  v-for="rule in product.mod_rules" :rule="rule" :modificators="product.modificators"></mod-rule>
    </div>
</template>

<style></style>

<script>
    import ModRule from './_modRule.vue';

    export default {
        props: ['product'],
        data(){
            return {
                actions: ['disabled', 'hide'],
                toggle_options: [],
                newRule: {
                    toggle_id: '',
                    toggle_option_id: '',
                    target_id: '',
                    action: '',
                }

            }
        },
        methods: {
            getOptions(){
                axios.get('/admin/modificators/' + this.newRule.toggle_id + '/options')
                    .then(response => {
                            this.toggle_options = response.data;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            createRule(){
                axios.post('mod-rules', this.newRule)
                    .then(response => {
                        if (200 === response.status){
                            this.product.mod_rules.push(response.data);
                        }
                    })
                    .catch(error => {

                        console.log(error.response.data);

                    });
            },
            deleteRule(ruleToRemove){

                axios.delete('/admin/mod-rules/' + ruleToRemove.id)

                    .then(response => {
                        this.product.mod_rules = this.product.mod_rules.filter(rule => {
                            return  rule.id !== ruleToRemove.id;
                        });
                    })

                    .catch(error => {
                        console.log(error.response.data);
                    });
                /*axios.delete('/admin/mod-rules/' + ruleToRemove.id)


                    .then(response => {
                        if (200 === response.status){
                            this.product.mod_rules = this.mod_rules.filter(rule => {
                                return rule.id !== ruleToRemove.id;
                            })
                        }
                    })


                    .catch(error => {
                        console.log(error.response.data);
                    })
*/

            }
        },
        computed: {
            toggles(){
                return this.product.modificators.filter(mod => {
                    return mod.type !== 'text';
                });
            },
            targets(){
                return this.product.modificators.filter(mod => {
                    return mod.id !== this.newRule.toggle_id;
                });
            }
        },
        mounted() {
        },
        watch(){
        },
        components: {
            ModRule,
        }
    }
</script>
