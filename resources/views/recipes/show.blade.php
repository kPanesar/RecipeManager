@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @if($recipe->photo != '')
                    <img src="{{ asset('uploads/'.$recipe->photo) }}" class="img-responsive" alt="{{ $recipe->name }}">
                @endif
            </div>
        </div>
        <div class="row">
            <h1 class="edit_text">{{$recipe->name}}</h1>
            <p>{{$recipe->description}}</p>
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

        <example></example>
    </div>
@stop


