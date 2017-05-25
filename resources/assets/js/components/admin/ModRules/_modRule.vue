<template>
    <div class="media">

        <div class="media-content">
            When <span class="tag" v-text="modName(this.rule.toggle_id)"></span>
            has <span class="tag" v-text="'option'  + this.rule.toggle_option_id"></span>
            than <span class="tag" v-text="modName(this.rule.target_id)"></span>
            is <span class="tag" v-text="this.rule.action"></span>
        </div>
        <div class="media-right">
            <div class="field">
                <span @click="deleteRule" class="button is-small is-danger" >delete</span>
            </div>
        </div>

    </div>
</template>

<style></style>

<script>

    export default {
        props: ['rule', 'modificators'],
        data(){
            return {
            }
        },
        methods: {
            deleteRule(){
                this.$emit('delete-rule');
            },
            modName(mod_id){
                return this.modificators.filter(mod => {
                    return mod.id === mod_id;
                })[0].name;
            }
        },
        computed: {},
        mounted() {
        },
        components: {
        }
    }
</script>
