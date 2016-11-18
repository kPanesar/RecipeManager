<template>
    <div>
        <div class="modal-header" v-if="my_recipe.photo">
            <img v-bind:src="image_url" alt="Recipe Image" class="recipe-img">
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
                            <input id="name" type="text"  v-model="my_recipe.name" class="form-control form-title" placeholder="Recipe Name">
                        </div>
                        <div class="form-group">
                            <label for="description" class="sr-only">Description</label>
                            <textarea id="description" v-model="my_recipe.description" class="form-control" placeholder="Recipe Description"></textarea>
                        </div>
                        <div>
                            <input type="file" v-on:change="grabImage">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <h2 class="recipe-subtitle">Ingredients</h2>
                    <div v-show="showForm">
                        <div class="row" >
                            <div class="col-xs-4 thin-column-right">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <input id="quantity"
                                       type="number"
                                       v-model="new_ingredient.quantity"
                                       class="form-control"
                                       placeholder="Qt.">
                            </div>
                            <div class="col-xs-8 thin-column-left">
                                <label for="unit" class="sr-only">Unit</label>
                                <input id="unit"
                                       type="text"
                                       v-model="new_ingredient.unit"
                                       class="form-control"
                                       placeholder="Unit">
                            </div>
                        </div>
                        <div class="row space-top">
                            <div class="col-xs-10 thin-column-right">
                                <label for="ingredient-name" class="sr-only">Name</label>
                                <input id="ingredient-name"
                                       type="text"
                                       v-model="new_ingredient.name"
                                       class="form-control"
                                       placeholder="Ingredient">
                            </div>
                            <div class="col-xs-2 thin-column-left">
                                <button class="btn btn-primary" @click="addIngredient"><span class="glyphicon glyphicon-plus"></span></button>
                                <br>
                            </div>
                        </div>
                    </div>

                    <ul class="list-unstyled">
                        <ingredient v-for="(ingredient, index) in my_recipe.ingredients"
                                    :ingredient="ingredient"
                                    :editable="showForm"
                                    v-on:removeIngredient="my_recipe.ingredients.splice(index, 1)"
                        ></ingredient>
                    </ul>
                </div>
                <div class="col-sm-7">
                    <h2 class="recipe-subtitle">Directions</h2>
                    <div class="row" v-show="showForm">
                        <div class="col-xs-3 thin-column-right">
                            <label for="step-num" class="sr-only">Step Number</label>
                            <input id="step-num"
                                   type="number"
                                   v-model="new_direction.step_num"
                                   class="form-control"
                                   placeholder="Step">
                        </div>
                        <div class="col-xs-8 thin-column">
                            <label for="direction-text" class="sr-only">Direction</label>
                            <input id="direction-text"
                                   type="text"
                                   v-model="new_direction.direction_text"
                                   class="form-control"
                                   placeholder="Direction">
                        </div>
                        <div class="col-xs-1 thin-column-left">
                            <button class="btn btn-primary" @click="addDirection"><span class="glyphicon glyphicon-plus"></span></button>
                            <br>
                        </div>
                    </div>

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
            <button type="button" class="btn btn-danger pull-left" @click="destroyRecipe" data-dismiss="modal" v-show="editable">Delete</button>
            <transition name="fade">
                <button type="button" class="btn btn-success" @click="updateRecipe" v-show="showForm">Save Changes</button>
            </transition>
            <button type="button" class="btn btn-default" @click="cancelChanges" v-show="editable">Cancel</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" v-show="!showForm">Close</button>
            <button type="button" class="btn btn-default" @click="clearRecipe" data-dismiss="modal" v-show="create_mode">Cancel</button>
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

    function uplodadFile(file) {

        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'recipes/photos',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                //Celebrations!
            },
            error: function(data){
                console.log("Ah snap. Something went wrong.");
            }
        });
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
                        directions: [],
                        files: null
                    },
                editable: false,
                create_mode: false,
                image: null,
                image_url: ''
            }
        },

        mounted() {
        },

        watch: {
            recipe: function (newVal) {
                this.clearRecipe();
                this.create_mode = this.isCreateMode();
                if(!this.create_mode){
                    this.fetchData(newVal);
                }
            }
        },

        methods: {

            fetchData: function( url ) {
                $.getJSON( url, function( data ) {
                    this.my_recipe = data.recipe;
                    this.image_url = ('uploads/' + this.my_recipe.photo);
                }.bind(this));
            },

            grabImage: function (e) {
                var files = e.target.files;

                if (files.length > 0){
                    this.image = files[0];
                }

                this.image_url = URL.createObjectURL(this.image);
            },

            addIngredient: function (e) {
                e.preventDefault();

                if(this.new_ingredient.name != ''){
                    this.new_ingredient.recipe_id =  this.my_recipe.id;
                    if(this.new_ingredient.quantity != null){
                        //Convert quantity to a number
                        this.new_ingredient.quantity = parseInt(this.new_ingredient.quantity);
                    }
                    this.my_recipe.ingredients.push(this.new_ingredient);

                    //Preserve user form inputs
                    this.new_ingredient =
                    {
                        quantity    : null,
                        unit        : '',
                        name        : '',
                        recipe_id   : this.my_recipe.ingredients.recipe_id
                    }
                }
            },

            addDirection: function (e) {
                e.preventDefault();
                // Only add the direction if it contains text
                if(this.new_direction.direction_text != ''){
                    this.my_recipe.directions.push(this.new_direction);
                }

                // Reset the direction variable
                this.new_direction =
                    {
                        step_num        : null,
                        direction_text  : ''
                    }
            },

            updateRecipe: function() {

                //Update the recipe photo and upload it to the server
                if(this.image){
                    this.my_recipe.photo = this.image.name;
                    uplodadFile(this.image);
                    this.uploaded = true;
                }

                $.ajax({
                    type: this.requestType,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: this.recipe,
                    data: this.my_recipe,
                    success: function(data) {
                        // Celebrations!
                    }
                });

                // Return to view Mode
                this.editable = this.create_mode = false;
            },

            destroyRecipe: function() {
                $.ajax({
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: this.recipe,
                    data: this.my_recipe,
                    success: function(data) {
                        // Celebrations!
                    }
                });

                this.clearRecipe();
            },

            cancelChanges: function(){
                // Rollback changes to the original state
                this.my_recipe = temp_recipe;
                this.image_url = ('uploads/' + this.my_recipe.photo);
                this.image = null;

                this.editable = false;
            },

            clearRecipe: function () {
                this.my_recipe = {
                                    name: '',
                                    description: '',
                                    ingredients: [],
                                    directions: [],
                                    files: null
                                 }
            },

            makeEditable: function () {
                // Save recipe state in case the changes need to be cancelled
                temp_recipe = clone(this.my_recipe);

                this.editable = true;
            },

            isCreateMode: function () {
                var last = this.recipe.length;
                var substring = this.recipe.substring(last-7, last);
                return (substring == 'recipes');
            }
        },

        // Order the directions by step number
        computed: {
            orderedDirections: function () {
                return renumberList(_.orderBy(this.my_recipe.directions, 'step_num'));
            },

            showForm: function () {
                return (this.editable || this.create_mode);
            },

            requestType: function () {
                if(this.create_mode) return 'POST';
                else return 'PUT';
            }
        },

        // Register the components locally
        components: {
            'ingredient'    : require('./Ingredient.vue'),
            'direction'     : require('./Direction.vue')
        }
    }

</script>