<template>
    <div>
        <li>
            {{direction.step_num}}) {{direction.direction_text}}
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
