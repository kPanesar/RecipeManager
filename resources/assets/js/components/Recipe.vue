<template>
    <div>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name"  v-model="my_recipe.name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description"  v-model="my_recipe.description" class="form-control"></textarea>
            </div>
            <div>
                <input type="file" v-on:change="changeName">
            </div>
        </form>
        <br>
        <h4>Ingredients</h4>
        <form class="form-inline">
            <div class="form-group">
                <label for="quantity" class="sr-only">Quantity</label>
                <input id="quantity"
                       type="number"
                       v-model="new_ingredient.quantity"
                       class="form-control"
                       placeholder="Quantity">
            </div>
            <div class="form-group">
                <label for="unit" class="sr-only">Unit</label>
                <input id="unit"
                       type="text"
                       v-model="new_ingredient.unit"
                       class="form-control"
                       placeholder="Unit">
            </div>
            <div class="form-group">
                <label for="ingredient-name" class="sr-only">Name</label>
                <input id="ingredient-name"
                       type="text"
                       v-model="new_ingredient.name"
                       class="form-control"
                       placeholder="Ingredient">
            </div>
            <button class="btn btn-default" @click="addIngredient">Add Ingredient</button>
        </form>

        <br>

        <ul class="list-group">
            <ingredient v-for="(ingredient, index) in my_recipe.ingredients"
                       :ingredient="ingredient"
                       v-on:removeIngredient="my_recipe.ingredients.splice(index, 1)"
            ></ingredient>
        </ul>

        <h4>Directions</h4>
        <form class="form-inline">
            <div class="form-group">
                <label for="step-num" class="sr-only">Step Number</label>
                <input id="step-num"
                       type="text"
                       v-model="new_direction.step_num"
                       class="form-control"
                       placeholder="Step Number">
            </div>
            <div class="form-group">
                <label for="direction-text" class="sr-only">Direction</label>
                <input id="direction-text"
                       type="text"
                       v-model="new_direction.direction_text"
                       class="form-control"
                       placeholder="Direction">
            </div>
            <button class="btn btn-default" @click="addDirection">Add Direction</button>
        </form>

        <br>

        <ol class="list-group" ref="sortable">
            <direction v-for="(direction, index) in orderedDirections"
                        :key="direction.step_num"
                        :direction="direction"
                        v-on:removeDirection="my_recipe.directions.splice(index, 1)"
            ></direction>
        </ol>
    </div>
</template>

<script>
    export default{
        props: ['recipe'],

        data: function () {
            return{
                new_ingredient:
                    {
                        quantity: null,
                        unit    : '',
                        name    : ''
                    },
                new_direction:
                    {
                        step_num        : null,
                        direction_text  : ''
                    },
                my_recipe: this.recipe
            }
        },

        methods: {
            changeName: function (e) {
                this.my_recipe.photo = e.target;
            },

            addIngredient: function (e) {
                e.preventDefault();
                this.my_recipe.ingredients.push(this.new_ingredient);
                this.new_ingredient =
                    {
                        quantity: null,
                        unit    : '',
                        name    : ''
                    }
            },

            addDirection: function (e) {
                e.preventDefault();
                this.my_recipe.directions.push(this.new_direction);
                this.new_direction =
                    {
                        step_num        : null,
                        direction_text  : ''
                    }
            }
        },

        components: {
            'ingredient'    : require('./Ingredient.vue'),
            'direction'     : require('./Direction.vue'),
            'ingredientform': require('./IngredientForm.vue'),
            'directionform' : require('./DirectionForm.vue')
        },

        computed: {
            orderedDirections: function () {
                return _.orderBy(this.my_recipe.directions, 'step_num')
            }
        },

        mounted() {
        }
    }
</script>

<style>
    .list-group {
        line-height:40px;
    }
</style>