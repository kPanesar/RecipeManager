<template>
    <li>{{quantity}} {{ unit }} {{ name }}</li>
</template>

<script>
    export default {

        props: ['quantity', 'unit', 'name'],

        mounted() {
        }

    }
</script>
