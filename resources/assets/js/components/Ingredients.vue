<template>
    <div>
        <h4>Ingredients</h4>
        <ul class="list-group">
            <li class="list-group-item" v-for="ingredient in ingredients">
                {{ingredient.quantity}} {{ingredient.unit}} {{ingredient.name}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

        props: ['ingredients'],

        mounted() {
        }

    }
</script>
