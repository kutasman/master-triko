<template>
    <div class="columns">
        <div class="column is-8">

            <div v-if="!editMod" v-for="factory in factories" class="media">
                <div class="media-content">
                    <strong><a @click="editFactory(factory)">{{ factory.name }}</a></strong>
                </div>
                <div class="media-right">
                    <div class="delete"></div>
                </div>
            </div>
            <factory v-else :factory="editedFactory"></factory>

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
                editedFactory:{}
            }
        },
        methods: {
            editFactory(factory){
                window.location.href = 'factories/'+ factory.id + '/edit';
            }
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
