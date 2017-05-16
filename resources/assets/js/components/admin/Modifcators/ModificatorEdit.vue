<template>
    <div>
        <div class="box">
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

        <mod-options v-show="modificator.type !== 'text'" :modificator="modificator"></mod-options>

    </div>
</template>

<style></style>

<script>

    import ModOptions from './Options/ModOptions.vue';
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
