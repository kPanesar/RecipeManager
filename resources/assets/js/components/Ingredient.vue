<template>
    <div>
        <li class="list-group-item">
            {{ingredient.quantity}} {{ingredient.unit}} {{ingredient.name}}
            <span class="pull-right">
                <button type="button" class="btn btn-danger" v-on:click="$emit('removeIngredient')" v-show="editable">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </span>
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
