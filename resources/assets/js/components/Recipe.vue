<template>
    <div>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div>
                <img src="" alt="Recipe Image">
            </div>
        </div>
        <div class="modal-body">
            <div v-show="!editable">
                <button class="btn btn-default pull-right" @click="makeEditable"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                <h1>{{ my_recipe.name }}</h1>
                <p>{{ my_recipe.description }}</p>
            </div>
            <form v-show="editable">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name"  v-model="my_recipe.name" class="form-control">
                    <span class="bar"></span>
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
            <form class="form-inline" v-show="editable">
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
                <br>
            </form>

            <ul class="list-unstyled">
                <ingredient v-for="(ingredient, index) in my_recipe.ingredients"
                            :ingredient="ingredient"
                            :editable="editable"
                            v-on:removeIngredient="my_recipe.ingredients.splice(index, 1)"
                ></ingredient>
            </ul>

            <br>

            <h4>Directions</h4>
            <form class="form-inline" v-show="editable">
                <div class="form-group">
                    <label for="step-num" class="sr-only">Step Number</label>
                    <input id="step-num"
                           type="number"
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
                <br>
            </form>

            <ul class="list-unstyled">
                <direction v-for="(direction, index) in orderedDirections"
                           :key="direction.step_num"
                           :direction="direction"
                           :editable="editable"
                           v-on:removeDirection="my_recipe.directions.splice(index, 1)"
                ></direction>
            </ul>
        </div>
        <div class="modal-footer">
            <transition name="fade">
                <button type="button" class="btn btn-success" @click="updateRecipe" v-show="editable">Save Changes</button>
            </transition>
            <button type="button" class="btn btn-default" @click="cancelChanges" v-show="editable">Cancel</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" v-show="!editable">Close</button>
        </div>
    </div>
</template>

<script>

    // ----- Helper variables and functions ----- //
    var temp_recipe;

    function clone(obj){
        if(obj == null || typeof(obj) != 'object')
            return obj;

        var temp = new obj.constructor();
        for(var key in obj)
            temp[key] = clone(obj[key]);

        return temp;
    }

    function renumberList(list) {
        for(var index in list){
            list[index].step_num = (parseInt(index) + 1).toString();
        }
        return list;
    }
    // ----- End Helper variables and functions ----- //

    export default{
        props: ['recipe'],

        data: function () {
            return{
                new_ingredient:
                    {
                        quantity    : null,
                        unit        : '',
                        name        : '',
                        recipe_id   : null
                    },
                new_direction:
                    {
                        step_num        : null,
                        direction_text  : ''
                    },
                my_recipe : {
                                name: "Still Cookin'",
                                description: "Your recipe is cooking. Please wait."
                            }, //Message to display while fetching data
                editable: false
            }
        },

        mounted() {

        },

        watch: {
            recipe: function (newVal) {
                this.fetchData(newVal);
            }
        },

        methods: {

            fetchData: function( url ) {
                $.getJSON( url, function( data ) {
                    this.my_recipe = data.recipe;
                }.bind(this));

            },

            changeName: function (e) {
                this.my_recipe.photo = e.target;
            },

            addIngredient: function (e) {
                e.preventDefault();
                this.new_ingredient.recipe_id =  this.my_recipe.id;
                this.my_recipe.ingredients.push(this.new_ingredient);
                this.new_ingredient =
                    {
                        quantity    : null,
                        unit        : '',
                        name        : '',
                        recipe_id   : this.my_recipe.ingredients.recipe_id
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
            },

            updateRecipe: function() {
                $.ajax({
                    type:"PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: this.recipe,
                    data: this.my_recipe,
                    success: function(data) {
                        alert('Recipe saved');
                    }
                });

                // Return to view Mode
                this.editable = false;
            },

            cancelChanges: function(){
                // Rollback changes to the original state
                this.my_recipe = temp_recipe;

                this.editable = false;
            },

            makeEditable: function () {
                // Save recipe state in case the changes need to be cancelled
                temp_recipe = clone(this.my_recipe);

                this.editable = true;
            }
        },

        // Order the directions by step number
        computed: {
            orderedDirections: function () {
                return renumberList(_.orderBy(this.my_recipe.directions, 'step_num'));
            }
        },

        // Register the components locally
        components: {
            'ingredient'    : require('./Ingredient.vue'),
            'direction'     : require('./Direction.vue')
        }
    }

</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>