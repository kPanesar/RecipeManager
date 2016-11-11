<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>
                    <div class="panel-body">
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    var data = { counter: 0 }

    export default {

        props: ['message'],

        data(){
            return{
                counter: 0
            };
        },

        mounted() {
            console.log('Component ready.')
        }
    }

</script>
