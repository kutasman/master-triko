<template>
    <div class="media">
        <div class="media-content">

            <strong><a @click="editMod">{{ modificator.name }}</a></strong>


        </div>
        <div class="media-right">
            <div class="field">
                <span v-show="modificator.type === 'radio'" :class="isToggle ? 'is-success' : 'is-warning'" class="tag is-small"  v-text="'is toggle'"></span>
                <span class="button is-small is-danger" @click="deleteMod">delete</span>
            </div>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['modificator', 'modificators'],
        data(){
            return {
                isToggle: false,
            }
        },
        methods: {
            editMod(){
                this.$emit('edit-modificator');
            },
            deleteMod(){
                this.$emit('delete-mod')
            },
            makeTrigger(){


                this.isToggle = true;
            },
            removeTrigger(){


                this.isToggle = false;

            },
            toggleTrigger(){
                if (this.isToggle){
                    this.removeTrigger();
                } else {
                    this.makeTrigger();
                }
            }
        },
        computed: {},
        mounted() {

        },
        components: {
        }
    }
</script>
