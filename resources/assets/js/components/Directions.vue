<template>
    <div>
        <h4>Directions</h4>
        <button class="btn btn-success" @click="printConsole">Create Step</button>
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
            printConsole: function(){
                console.log('I have ran this function!!');
            }
        },

        mounted() {
        }
    }
</script>
