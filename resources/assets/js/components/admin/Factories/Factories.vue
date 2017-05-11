<template>
    <div class="columns">
        <div class="column is-6">
            <div class="media" v-for="factory in factories">
                <div class="media-content">
                    <strong><a @click="editFactory(factory)">{{ factory.name }}</a></strong>
                </div>
                <div class="media-right">
                    <div @click="deleteFactory(factory)" class="delete"></div>
                </div>
            </div>


        </div>
        <div class="column is-6">
            <div class="columns">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input type="text" v-model="newFactory.name" class="input" placeholder="Factory name"/>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Slug</label>
                    <div class="control">
                        <input type="text" class="input" v-model="newFactory.slug" placeholder="Slug"/>
                    </div>
                </div>
                <div class="field">
                    <label class="label"></label>
                    <div class="control">
                        <span @click="createFactory" class="button is-primary">create</span>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<style></style>

<script>

    export default {
        props: ['factoriesInit'],
        data(){
            return {
                factories: [],
                newFactory: {
                    name: '',
                    slug: ''
                },
                editedFactory:{}
            }
        },
        methods: {
            editFactory(factory){
                window.location.href = 'factories/'+ factory.id + '/edit';
            },
            createFactory(){
                axios.post('factories', this.newFactory)
                    .then(response => {
                        this.factories.push(response.data);
                        this.newFactory = {name:'',slug:''}
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            deleteFactory(factory){
                axios.delete('factories/' + factory.id)
                    .then(response => {
                        if (200 === response.status){
                            this.factories = this.factories.filter(f => {
                                return f.id !== factory.id;
                                this.newFactory = {name:'',slug:''}

                            })
                        }
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
            },

        },
        computed: {
            editMod(){
                return !_.isEmpty(this.editedFactory);
            }
        },
        mounted() {
            this.factories = this.factoriesInit;
        },
        components: {}
    }
</script>
