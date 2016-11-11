@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @if($recipe->photo != '')
                    <img src="{{ asset('uploads/'.$recipe->photo) }}" class="img-responsive" alt="{{ $recipe->name }}">
                @endif
            </div>
            <div class="col-sm-8">
                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-default">Edit</a>

                {{--Delete Button--}}
                {!! Form::open(array(
                                  'style' => 'display: inline-block;',
                                  'method' => 'DELETE',
                                  'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                                  'route' => ['recipes.destroy', $recipe->id])) !!}
                {!! Form::submit('Delete', array('class' => 'btn btn-primary')) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div id="recipe" class="row">
            <h1 class="edit_text">{{$recipe->name}}</h1>
            <p>{{$recipe->description}}</p>

            <br>

            <h4>Ingredients</h4>
            <ul>
                @foreach($recipe->ingredients as $ingredient)
                    <ingredient
                            quantity    = "{{ $ingredient->quantity }}"
                            unit        = "{{ $ingredient->unit }}"
                            name        = "{{ $ingredient->name }}"
                    ></ingredient>
                @endforeach
            </ul>

            <br>

            <h4>Directions</h4>
            <ol>
                @foreach($recipe->directions as $direction)
                    <direction
                            step        = "{{ $direction->step_num }}"
                            direction   = "{{ $direction->direction_text }}"
                    ></direction>
                @endforeach
            </ol>

        </div>
    </div>
@stop


