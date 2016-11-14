<template>
    <div>
        <li>
            {{ingredient.quantity}} {{ingredient.unit}} {{ingredient.name}}
            <span class="glyphicon glyphicon-remove" v-on:click="$emit('removeIngredient')" v-show="editable"></span>
        </li>
    </div>
</template>

<script>
    export default {

        props: ['ingredient', 'editable'],

        mounted() {
        }

    }
</script>
