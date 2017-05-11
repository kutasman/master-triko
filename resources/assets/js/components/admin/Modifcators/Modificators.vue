<template>
    <div>
        <div class="columns">
            <div class="column">
                <modificator @edit-modificator="toggleEditMod(mod)" @delete-mod="deleteMod(mod)" v-for="mod in modificators" :modificator="mod"></modificator>
            </div>
            <div class="column">

                <!--<modificator-form :modificator="editedModificator"></modificator-form>-->
                <modificator-edit :modificator="editedModificator" v-if="editMode"></modificator-edit>
                <!--<modificator-create @create-modificator="createModificator" v-else></modificator-create>-->
                <div v-else class="field has-addons has-addons-centered">
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
            </div>
        </div>
    </div>
</template>

<style></style>

<script>
    import Modificator from './Modificator.vue';
    import ModificatorForm from './ModificatorForm.vue';
    import ModificatorEdit from './ModificatorEdit.vue';

    import ModificatorCreate from './ModificatorCreate.vue';
    export default {
        props: ['modificatorsInit', 'product'],
        data(){
            return {
                modificableType: '',
                modificable: {},
                modificators: [],
                editedModificator:{},
                types: ['text', 'select'],
                newMod:{
                    name:'',
                    type: 'text',
                }
            }
        },
        methods: {
            removeModFromMods(id){
                this.modificators = this.modificators.filter(mod => {
                    return mod.id !== id;
                })
            },
            editModificator(mod){
                this.editedModificator = mod;
            },
            createModificator(){
                switch (this.modificableType){
                    case '':
                        axios.post('/admin/modificators', this.newMod)
                            .then(response => {
                                if (200 === response.status){
                                    this.modificators.push(response.data);
                                }
                            })
                            .catch(error => {
                                console.log(error.response.data);
                            });
                        break;
                    case 'products':
                        axios.post('/admin/products/' + this.modificable.id + '/create-modificator', this.newMod)
                            .then(response => {
                                if (200 === response.status){
                                    this.modificators.push(response.data);
                                }
                            })
                            .catch(error => {
                                console.log(error.response.data);
                            });
                        break;
                }

            },
            toggleEditMod(mod){
                if (!_.isEmpty(this.editedModificator) && this.editedModificator.id === mod.id){
                    this.editedModificator = {}
                }  else {
                    this.editModificator(mod);
                }
            },
            deleteMod(deletedMod){
                switch (this.modificableType){
                    case '':
                        axios.delete('/admin/modificators/' + deletedMod.id)
                            .then(response => {
                                if (200 === response.status){
                                    this.removeModFromMods(deletedMod.id);
                                }
                            });
                        break;
                    case 'products':
                        axios.delete('/admin/products/' + this.modificable.id + '/detach-modificator', {modificator: deletedMod.id})
                            .then(response => {
                                if (200 === response.status){
                                    this.removeModFromMods(deletedMod.id);
                                }
                            })
                            .catch(error => {
                                console.log(error.response.data);
                            });
                        break;
                }

            }
        },
        computed: {
            editMode(){
                return !_.isEmpty(this.editedModificator);
            },
            modIds(){
                return this.modificators.map(mod => {
                    return mod.id;
                });
            }
        },
        mounted() {
            if (!_.isEmpty(this.modificatorsInit)){

                this.modificators = this.modificatorsInit;

            } else if (!_.isEmpty(this.product)){

                this.modificators = this.product.modificators;
                this.modificableType = 'products';
                this.modificable = this.product;

            }
        },
        components: {
            Modificator,
            ModificatorForm,
            ModificatorCreate,
            ModificatorEdit,
        }
    }
</script>
