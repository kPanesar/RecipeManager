<template>
    <li>
        <strong>{{ingredient.quantity}} {{ingredient.unit}}</strong> {{ingredient.name}}
        <span class="glyphicon glyphicon-remove remove-item" v-on:click="$emit('removeIngredient')" v-show="editable"></span>
    </li>
</template>

<script>
    export default {

        props: ['ingredient', 'editable'],

        mounted() {
        }

    }
</script>
