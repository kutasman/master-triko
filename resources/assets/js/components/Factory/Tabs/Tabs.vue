<template>
    <div>
        <div class="tabs">
            <ul>
                <li @click="setTab('description')" :class="{'is-active': isTab('description')}"><a>Description</a></li>
            </ul>
        </div>

        <component :is="tab"></component>
    </div>
</template>

<style></style>

<script>

    import Description from './Description.vue';
    export default {
        props: [],
        data(){
            return {
                tab: 'description',

            }
        },
        methods: {
            isTab(name){
                return this.tab === name;
            },
            setTab(name){
                this.tab = name;
            }
        },
        computed: {},
        mounted() {
        },
        components: {
            Description
        }
    }
</script>
