
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
        current_recipe: "Hello"
    }
});

$('#recipeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipeObject = button.data('recipe') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    // var modal = $(this)
    // var modal_body = "<recipe :recipe_url=\"" + recipe_url + "\"></recipe>";
    //
    // console.log(modal_body);
    // modal.find('.modal-content').html(modal_body);
    recipeVM.$data.current_recipe = recipeObject;
    // console.log(recipe.$data.current_recipe);
})