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

            <ingredients :ingredients="{{ $recipe->ingredients }}"></ingredients>

            <br>

            <directions :directions="{{ $recipe->directions }}"></directions>

        </div>
    </div>
@stop


