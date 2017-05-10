<template>
    <div class="container is-fluid">
        <div class="columns">
            <div class="column is-7">
                <div v-for="mod in product.modificators">
                    {{ mod }}
                </div>
            </div>
            <div class="column is-5">
                <div class="box">
                    <h3 class="title is-3">Factory modificators</h3>
                    <div v-for="mod in factoryMods" class="field">
                        <p class="control">
                            <label class="checkbox">
                                <input @change="syncMods" :id="'mod-' + mod.id" v-model="product.modificators" :value="mod" type="checkbox">
                                {{ mod.name }}
                            </label>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <h3 class="title is-3">Personal modificators</h3>
                </div>
            </div>
        </div>
        <slot></slot>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['product'],
        data(){
            return {
                factoryMods: [],
                mods:[]
            }
        },
        methods: {
            syncMods(){

            }
        },
        computed: {

        },
        mounted() {
            axios.get('../../factories/'+ this.product.factory_id+'/modificators')
                .then(response => {
                    this.factoryMods = response.data;
                })
                .catch(error => {
                    console.log(error.response.data);
                })
        },
        components: {}
    }
</script>
