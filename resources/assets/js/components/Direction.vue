<template>
    <div>
        <li class="list-group-item">
            {{direction.step_num}} {{direction.direction_text}}
            <span class="pull-right">
                <button type="button" class="btn btn-danger" v-on:click="$emit('removeDirection')" v-show="editable">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </span>
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
