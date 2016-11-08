@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="edit_text">{{$recipe->name}}</h1>
            <p>{{$recipe->description}}</p>
            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-default">Edit</a>
            {!! Form::open(array(
                              'style' => 'display: inline-block;',
                              'method' => 'DELETE',
                              'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                              'route' => ['recipes.destroy', $recipe->id])) !!}
            {!! Form::submit('Delete', array('class' => 'btn btn-primary')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop


