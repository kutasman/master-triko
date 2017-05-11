<template>
    <div class="media">
        <div class="field is-horizontal">
            <div class="field-body">

                <div class="field">
                    <div class="control">
                        <input type="text" class="input" v-model="option.name" placeholder="rise"/>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <input type="number" v-model="option.rise" class="input" placeholder="rise"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="media-right">
            <span class="delete" @click="deleteOption"></span>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ["option"],
        data(){
            return {}
        },
        methods: {
            deleteOption(){
                this.$emit('delete-option')
            }
        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
