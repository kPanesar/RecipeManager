
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Vue = require('vue');
Vue.use(require('vue-resource'));
// Vue.use(require('vue-drag'));

Vue.component('recipe', require('./components/Recipe.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

const recipeVM = new Vue({
    el: '#recipe',
    data: {
        current_recipe: "",
    }
});

$('#recipeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    recipeVM.$data.current_recipe = button.data('recipe');
});

$('#recipeModal').on('hidden.bs.modal', function () {
    //Update the recipes on modal close
})