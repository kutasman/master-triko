<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ factory.name }}</h3>
        </div>
        <div class="panel-body">
            {{ factory }}

        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['factory'],
        data(){
            return {}
        },
        methods: {},
        computed: {},
        mounted() {
        },
        components: {}
    }
</script>
