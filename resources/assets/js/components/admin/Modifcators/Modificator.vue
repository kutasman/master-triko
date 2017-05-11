<template>
    <div class="media">
        <div class="media-content">
            <strong><a @click="editMod">{{ modificator.name }}</a></strong>
        </div>
        <div class="media-right">
            <span class="delete" @click="deleteMod"></span>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['modificator'],
        data(){
            return {
            }
        },
        methods: {
            editMod(){
                this.$emit('edit-modificator');
            },
            deleteMod(){
                this.$emit('delete-mod')
            }
        },
        computed: {},
        mounted() {

        },
        components: {}
    }
</script>
