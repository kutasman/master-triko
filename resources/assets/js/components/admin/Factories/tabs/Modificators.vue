<template>
    <div>
        <div class="columns">
            <div class="column is-one-third">
                <modificator @delete-mod="deleteMod(mod)" @edit-modificator="editModificator(mod)" v-for="mod in mods" :modificator="mod"></modificator>
            </div>
            <div class="column is-two-thirds">
                <modificator-form v-if="editMod" :modificator="editedMod"></modificator-form>

                <div v-else class="field has-addons has-addons-centered">

                    <p class="control">
                        <input v-model="newMod.name" class="input" type="text" placeholder="New modificator name">
                    </p>
                    <p class="control">
                        <span class="select">
                          <select v-model="newMod.type">
                            <option v-for="type in modTypes" :value="type" v-text="type"></option>
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

    import Modificator from '../../Modifcators/Modificator.vue';
    import ModificatorForm from '../../Modifcators/ModificatorForm.vue';
    export default {
        props: ['factory'],
        data(){
            return {
                mods: [],
                modTypes:['text', 'select'],
                newMod: {
                    name: '',
                    type: 'text'
                },
                editedMod: {}
            }
        },
        methods: {
            editModificator(mod){
                if ( _.isEmpty(this.editedMod) || this.editedMod.id !== mod.id ){
                    this.editedMod = mod;
                } else {
                    this.editedMod = {};
                }
            },
            createModificator(){
                axios.post('modificator', this.newMod)
                    .then(response => {
                        this.mods.push(response.data);
                        this.newMod = {name:'', type:'text'}
                    })
            },
            deleteMod(mod){
                axios.delete('/admin/modificators/' + mod.id)
                    .then(response => {
                        if (200 === response.status){
                            this.mods = this.mods.filter(modificator => {
                                return modificator.id !== mod.id;
                            });
                            this.editedMod = {};
                        }
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
            }
        },
        computed: {
            editMod(){
                return !_.isEmpty(this.editedMod);
            }
        },
        mounted() {
            axios.get('modificators')
                .then(response => {
                    this.mods = response.data;
                })
        },
        components: {
            Modificator,
            ModificatorForm,
        }
    }
</script>
