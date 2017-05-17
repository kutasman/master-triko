<template>
    <div class="media">

        <div class="media-content">
            When <span class="tag" v-text="'Mod ' + this.rule.modificator_id"></span>
            has <span class="tag" v-text="'option'  + this.rule.option_id"></span>
            than <span class="tag" v-text="'Mod ' + this.rule.target_id"></span>
            is <span class="tag" v-text="this.rule.action"></span>
        </div>
        <div class="media-right">
            <div class="field">
                <span @click="removeRule" class="button is-small is-danger" >delete</span>
            </div>
        </div>

    </div>
</template>

<style></style>

<script>

    export default {
        props: ['rule'],
        data(){
            return {
            }
        },
        methods: {
            removeRule(){
                this.$emit('remove-rule', this.rule);
            }
        },
        computed: {},
        mounted() {
        },
        components: {
        }
    }
</script>
