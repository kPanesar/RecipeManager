@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-xs-6 col-sm-4 col-md-3">
                <button class="btn btn-default create-recipe" data-toggle="modal" data-target="#recipeModal" data-recipe="{{ route('recipes.create') }}">
                    <span class="glyphicon glyphicon-plus text-red icon-2x" aria-hidden="true"></span>
                    <p>Create Recipe</p>
                </button>
            </div>

            @if (count($recipes) > 0)
                @foreach ($recipes as $recipe)
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        {{--href="{{ route('recipes.show', [$recipe->id]) }}"--}}
                        <button class="btn btn-default recipe" data-toggle="modal" data-target="#recipeModal" data-recipe="{{ route('recipes.show', [$recipe->id]) }}">
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
                <h2>Nice and clean.</h2>
                <p>You seem to have no recipes yet. Maybe you should make one by clicking on the create button on the left.</p>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1" role="dialog" aria-labelledby="recipeModal">
        <div class="modal-dialog modal-lg" role="document">
            <div id="recipe" class="modal-content">
                <recipe :recipe="current_recipe" ></recipe>
            </div>
        </div>
    </div>

@stop


