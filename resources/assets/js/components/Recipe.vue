<template>
    <div>
        <div class="modal-header" v-if="my_recipe.photo">
            <img v-bind:src="imageUrl" alt="Recipe Image" class="recipe-img">
            <!--<img :src="image" />-->
        </div>
        <div class="modal-body recipe-modal">
            <div class="row">
                <div class="col-xs-12">
                    <div v-show="!showForm">
                        <button class="btn btn-default pull-right" @click="makeEditable"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        <h1>{{ my_recipe.name }}</h1>
                        <p>{{ my_recipe.description }}</p>
                    </div>
                    <form v-show="showForm">
                        <div class="form-group">
                            <label for="name" class="sr-only">Name</label>
                            <input id="name"  v-model="my_recipe.name" class="form-control form-title" placeholder="Recipe Name">
                            <span class="bar"></span>
                        </div>
                        <div class="form-group">
                            <label for="description" class="sr-only">Description</label>
                            <textarea id="description"  v-model="my_recipe.description" class="form-control" placeholder="Recipe Description"></textarea>
                        </div>
                        <div>
                            <input type="file" v-on:change="saveImage">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h2>Ingredients</h2>
                    <form class="form-inline" v-show="showForm">
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
                        <button class="btn btn-primary" @click="addIngredient"><span class="glyphicon glyphicon-plus"></span></button>
                        <br>
                    </form>

                    <ul class="list-unstyled">
                        <ingredient v-for="(ingredient, index) in my_recipe.ingredients"
                                    :ingredient="ingredient"
                                    :editable="showForm"
                                    v-on:removeIngredient="my_recipe.ingredients.splice(index, 1)"
                        ></ingredient>
                    </ul>
                </div>
                <div class="col-sm-8">
                    <h2>Directions</h2>
                    <form class="form-inline" v-show="showForm">
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
                        <button class="btn btn-primary" @click="addDirection"><span class="glyphicon glyphicon-plus"></span></button>
                        <br>
                    </form>

                    <ol class="rounded-list">
                        <direction v-for="(direction, index) in orderedDirections"
                                   :key="direction.step_num"
                                   :direction="direction"
                                   :editable="showForm"
                                   v-on:removeDirection="my_recipe.directions.splice(index, 1)"
                        ></direction>
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <transition name="fade">
                <button type="button" class="btn btn-success" @click="updateRecipe" v-show="showForm">Save Changes</button>
            </transition>
            <button type="button" class="btn btn-default" @click="cancelChanges" v-show="editable">Cancel</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" v-show="!showForm">Close</button>
            <button type="button" class="btn btn-default" @click="clearRecipe" data-dismiss="modal" v-show="createMode">Cancel</button>
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

    function createImage(file) {
        var image = new Image();
        var reader = new FileReader();

        reader.onload = (e) => {
            image = e.target.result;
        }
        return image;
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
                        recipe_id   : ''
                    },
                new_direction:
                    {
                        step_num        : null,
                        direction_text  : ''
                    },
                my_recipe: {
                        name: '',
                        description: '',
                        ingredients: [],
                        directions: []
                    },
                editable: false,
                image: null
            }
        },

        mounted() {
        },

        watch: {
            recipe: function (newVal) {
                this.clearRecipe();
                if(!this.createMode){
                    this.fetchData(newVal);
                }
            }
        },

        methods: {

            fetchData: function( url ) {
                $.getJSON( url, function( data ) {
                    this.my_recipe = data.recipe;
                }.bind(this));

            },

            saveImage: function (e) {
                var files = e.target.files;

                if (files.length > 0){
                    this.image = createImage(files[0]);
                }
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

            clearRecipe: function () {
                this.my_recipe = {
                                    name: '',
                                    description: '',
                                    ingredients: [],
                                    directions: []
                                 }
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
            },

            imageUrl: function () {
                return ('uploads/' + this.my_recipe.photo) ;
            },

            createMode: function () {
                var last = this.recipe.length;
                var substring = this.recipe.substring(last-6, last);
                return (substring == 'create');
            },

            showForm: function () {
                return (this.editable || this.createMode);
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

    ul, ol{
        margin-top: 15px;
    }
    ol{
        margin-left: -25px;
    }

</style>