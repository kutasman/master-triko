<template>
    <div>
        <div class="columns">
            <div class="field column">
                <label class="label">Name</label>
                <div class="control">
                    <input type="text" class="input" v-model="modificator.name"/>
                </div>
            </div>
            <div class="field column">
                <label class="label">Type</label>
                <div class="control">
                    <input class="input" v-model="modificator.type" disabled/>
                </div>
            </div>
        </div>


        <div class="options" v-show="modificator.type !== 'text'">
            <div class="field is-horizontal">
                <div class="field-label"><label class="label">New option</label></div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input type="text" class="input" v-model="newOption.name" placeholder="name"/>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input type="number" class="input" v-model="newOption.rise" placeholder="rise"/>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <span class="button" @click="addOption" >add option</span>

                        </div>
                    </div>
                </div>

            </div>

            <mod-option v-for="option in options" @delete-option="deleteOption(option)" :option="option"></mod-option>

        </div>



    </div>
</template>

<style></style>

<script>

    import ModOption from './Options/ModOption.vue';
    export default {
        props: ['modificator'],
        data(){
            return {
                options: [],
                newOption: {
                    name: '',
                    rise: 0,
                }

            }
        },
        methods: {
            getOptions(){
                if ('text' !== this.modificator.type){
                    axios.get('/admin/modificators/' + this.modificator.id + '/options')
                        .then(response => {
                            this.options = response.data;
                        })
                        .catch(error => {
                            console.log(error.response.data);
                        });
                }
            },
            addOption(){
                axios.post('/admin/modificators/'+ this.modificator.id +'/mod-options', this.newOption)
                    .then(response => {
                        this.options.push(response.data);
                        this.newOption = {name:'', rise:0};
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
            },
            deleteOption(deletedOption){
                axios.delete('/admin/mod-options/' + deletedOption.id)
                    .then(response => {
                        if (200 === response.status){
                            this.options = this.options.filter(option => {
                                return option.id !== deletedOption.id;
                            })
                        }
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    })
            }

        },
        computed: {},
        mounted() {
            this.getOptions();
        },
        watch:{
            modificator(){
                this.getOptions();
            }
        },
        components: {
            ModOption
        }
    }
</script>
