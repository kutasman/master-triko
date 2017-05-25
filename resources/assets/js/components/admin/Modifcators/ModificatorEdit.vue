<template>
    <div>

        <div class="tabs">
            <ul>
                <li @click="tab = 'general'" :class="{'is-active': tab === 'general'}"><a>General</a></li>
                <li @click="tab = 'options'" :class="{'is-active': tab === 'options'}"><a>Options</a></li>
            </ul>
        </div>



        <div v-if="tab === 'general'" class="box">
            <div class="field is-horizontal">
                <div class="field-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input type="text" class="input" v-model="modificator.name"/>
                        </div>
                    </div>
                    <div class="field" >
                        <label class="label">Type</label>
                        <div class="control">
                            <input class="input" v-model="modificator.type" disabled/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field ">
                <div class="control">
                    <span @click="updateModificator" class="button">update</span>
                </div>
            </div>
        </div>

        <mod-options v-if="modificator.type !== 'text' && tab ==='options'" :modificator="modificator"></mod-options>

    </div>
</template>

<style></style>

<script>

    import ModOptions from './Options/ModOptions.vue';

    export default {
        props: ['modificator', 'modificators'],
        data(){
            return {
                tab: 'general',
                options: [],
                newOption: {
                    name: '',
                    rise: 0,
                }
            }
        },
        methods: {
            updateModificator(){
                axios.put('/admin/modificators/' + this.modificator.id, this.modificator);
            },

        },
        computed: {},
        watch:{
        },
        mounted() {

        },
        components: {
            ModOptions,
        }
    }
</script>
