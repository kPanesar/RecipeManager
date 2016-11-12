
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('ingredientform', require('./components/IngredientForm.vue'));
Vue.component('directionform', require('./components/DirectionForm.vue'));
Vue.component('ingredients', require('./components/Ingredients.vue'));
Vue.component('directions', require('./components/Directions.vue'));

const recipe = new Vue({
    el: '#recipe'
});
