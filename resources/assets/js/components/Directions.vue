<template>
    <div>
        <h4>Directions</h4>
        <button class="btn btn-success">Create Step</button>
        <ol class="list-group">
            <li class="list-group-item" v-for="direction in directions">
                {{ direction.direction_text }}
            </li>
        </ol>

    </div>
</template>

<script>
    export default {

        props: ['directions'],

        methods: {

            fetchDirections: function () {
                var resource = this.$resource('api/directions/:id');

                resource.get(function (directions) {
                    this.directions = directions;
                }.bind(this));

//                this.$http.get('api/directions', function (directions) {
//                    console.log(directions);
//                }.bind(this));
            }
        },

        mounted() {
        }
    }
</script>
