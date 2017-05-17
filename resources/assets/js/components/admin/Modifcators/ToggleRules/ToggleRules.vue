<template>
    <div class="box">

        <div class="field is-horizontal">
            <div class="field-body">
                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.option_id">
                                <option  value="">select option</option>
                                <option v-for="option in selfOptions" v-text="option.name" :value="option.id"></option>
                          </select>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.target_id">
                                <option  value="">select target</option>
                                <option v-for="target in modificators" v-text="target.name" :value="target.id"></option>
                          </select>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <span class="select is-small">
                          <select v-model="newRule.action">
                                <option  value="">select status</option>
                                <option v-for="status in statuses" v-text="status" :value="status"></option>
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

        <!--<toggle-rule v-for="rule in rules" :relation="relation"></toggle-rule>-->
    </div>
</template>

<style></style>

<script>
    import ToggleRule from './_toggleRule.vue';

    export default {
        props: ['modificator', 'modificators'],
        data(){
            return {
                rules: [],
                selfOptions: [],
                statuses: ['disabled', 'hide'],
                newRule: {
                    option_id: '',
                    target_id: '',
                    action: '',
                }

            }
        },
        methods: {
            getOptions(mod, target){
                if ('text' !== mod.type){
                    axios.get('/admin/modificators/' + mod.id + '/options')
                        .then(response => {
                            switch (target){
                                case 'self':
                                    this.selfOptions = response.data;
                                    break;
                                case 'dependent':
                                    this.dependentOptions = response.data;
                                    break;
                            }
                        })
                        .catch(error => {
                            console.log(error.response.data);
                        });
                }
            },
            createRule(){
                axios.post('/admin/modificators/' + this.modificator.id + '/mod-rules', this.newRule)
                    .then(response => {
                        if (200 === response.status){
                            this.rules.push(response.data);
                        }
                    })
                    .catch(error => {

                        console.log(error.response.data);

                    });
            }
        },
        computed: {

        },
        mounted() {
            this.getOptions(this.modificator, 'self');
        },
        components: {
            ToggleRule

        }
    }
</script>
