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
            <div class="block">
                <span :class="{'is-loading' : busy}" @click="update" class="button is-small">update</span>
                <span class="delete" @click="deleteOption"></span>
            </div>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['option'],
        data(){
            return {
                busy: false,
            }
        },
        methods: {
            deleteOption(){
                this.$emit('delete-option')
            },
            update(){
                this.busy = true;

                axios.put('/admin/mod-options/' + this.option.id, this.option)
                    .then(response =>{
                        console.log(response.data);
                        this.busy = false;

                    });
            },


        },
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
