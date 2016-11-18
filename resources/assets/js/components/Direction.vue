<template>
    <li>
        {{direction.direction_text}}
        <span class="glyphicon glyphicon-remove remove-item" v-on:click="$emit('removeDirection')" v-show="editable"></span>
    </li>
</template>

<script>
    export default {

        props: ['direction', 'editable'],

        mounted() {
        }
    }
</script>
