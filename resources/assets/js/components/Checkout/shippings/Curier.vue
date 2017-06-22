<template>
    <div>
        <div class="field">
            <label class="label"></label>
            <div class="control">
                <div class="button is-success" @click="checkout.validate()">Next</div>
            </div>
        </div>
    </div>
</template>

<style></style>

<script>

    export default {
        props: ['checkout', 'shipping'],
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
