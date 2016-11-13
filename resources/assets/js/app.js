
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Vue = require('vue');
Vue.use(require('vue-resource'));

Vue.component('mytodo', require('./components/Recipe.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

const recipe = new Vue({
    el: '#recipe',

    data: {
        newTodoText: '',
        todos: [
            'Do the dishes',
            'Take out the trash',
            'Mow the lawn'
        ]
    },

    created: function () {
    },

    components: {
        'ingredients'   : require('./components/Ingredients.vue'),
        'directions'    : require('./components/Directions.vue'),
        'ingredientform': require('./components/IngredientForm.vue'),
        'directionform' : require('./components/DirectionForm.vue')
    },

    methods: {
        printConsole: function(){
            console.log("I've run this function!");
        },
        addSomething: function () {
            //this.recipes.push(Math.random());
        },
        addNewTodo: function () {
            this.todos.push(this.newTodoText)
            this.newTodoText = ''
        }
    }
});
