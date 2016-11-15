<template>
    <div>
        <li>
            <span class="recipe-bullet"></span><strong class="text-white">{{direction.step_num}}</strong> {{direction.direction_text}}
            <span class="glyphicon glyphicon-remove" v-on:click="$emit('removeDirection')" v-show="editable"></span>
        </li>
    </div>
</template>

<script>
    export default {

        props: ['direction', 'editable'],

        mounted() {
        }
    }
</script>
