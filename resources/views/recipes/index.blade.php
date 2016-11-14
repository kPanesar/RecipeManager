@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-xs-6 col-sm-4 col-md-3">
                <a href="{{ route('recipes.create') }}" class="btn btn-default create-recipe">
                    <span class="glyphicon glyphicon-plus text-red" aria-hidden="true"></span>
                    <p>Create Recipe</p>
                </a>
            </div>

            @if (count($recipes) > 0)
                @foreach ($recipes as $recipe)
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        {{--href="{{ route('recipes.show', [$recipe->id]) }}"--}}
                        <button class="btn btn-default recipe" data-toggle="modal" data-target="#recipeModal" data-recipe="{{ $recipe }}">
                            <div>
                                @if($recipe->photo != '')
                                    <img src="{{ asset('uploads/thumb/'.$recipe->photo) }}">
                                @else
                                    <img src="{{asset('images/red-cake.jpg')}}" alt="Red Cake">
                                @endif
                            </div>
                            <h3 class="text-left">{{$recipe->name}}</h3>
                        </button>
                    </div>
                @endforeach
            @else
                <h2>Yo you got no recipes. Maybe you should make one...</h2>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1" role="dialog" aria-labelledby="recipeModal">
        <div class="modal-dialog" role="document">
            <div id="recipe" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <recipe v-bind:recipe="current_recipe"></recipe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@stop


