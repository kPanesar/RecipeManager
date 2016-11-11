<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="step"> {{ step }} </label>
                <input ref="input" id="step" class="form-control" name="step" type="text"
                       v-bind:value="direction"
                       v-on:input="checkQuantity($event.target.value)">
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        props: ['step', 'direction'],

        mounted() {
        },

        methods: {
            checkStep: function(value){
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

            checkDirection: function(value){
                //Check the value
            }
        }

    }
</script>
