<template>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="quantity">
                <input ref="input" id="quantity" class="form-control" name="quantity" type="number"
                       v-bind:value="quantity"
                       v-on:input="checkQuantity($event.target.value)">
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label for="unit">
                <input id="unit" name="unit" class="form-control" type="text"
                       v-bind:value="unit"
                       v-on:input="checkUnit($event.target.value)">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="ingredient_name">
                <input id="ingredient_name" class="form-control" name="ingredient_name" type="text"
                       v-bind:value="name"
                       v-on:input="checkName($event.target.value)">
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        props: ['quantity', 'unit', 'name'],

        mounted() {
        },

        methods: {
            checkQuantity: function(value){
                //Check the value
                var formattedValue = value
                // Remove whitespace on either side
                .trim()
                // Shorten to 2 decimal places
                .slice(0, value.indexOf('.') + 3)
                // If the value was not already normalized,
                // manually override it to conform
                if (formattedValue !== value) {
                  this.$refs.input.value = formattedValue;
                }
                // Emit the number value through the input event
                this.$emit('input', Number(formattedValue))
            },

            checkUnit: function(value){
                //Check the value
            },

            checkName: function(value){
                //Check the value
            },
        }

    }
</script>
