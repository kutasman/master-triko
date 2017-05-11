<template>
    <div>
        <div class="tabs">
            <ul>
                <li @click="setTab('general')" :class="{'is-active': isTab('general')}"><a>General</a></li>
                <li @click="setTab('modificators')" :class="{'is-active': isTab('modificators')}"><a>Modificators</a></li>

            </ul>
        </div>

        <component :is="tab" :factory="factory"></component>


    </div>
</template>

<style></style>

<script>

    import General from './tabs/General.vue';
    import Modificators from '../Modifcators/Modificators.vue';

    export default {
        props: ['factoryInit'],
        data(){
            return {
                factory: {},
                tab: 'general',
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
            this.factory = this.factoryInit;
        },
        components: {
            Modificators,
            General,
        }
    }
</script>
