<template>
    <!--<h4>{{ recipes }}</h4>-->
    <div>
        <li>
            {{ todo }}
            <button v-on:click="$emit('remove')">X</button>
        </li>
    </div>
</template>

<script>
    export default{
        props: ['recipes', 'todo'],

        mounted() {
        }
    }
</script>