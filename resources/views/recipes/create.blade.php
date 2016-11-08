@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Create a Recipe</h1>
            {!! Form::open(['url' => 'recipes']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Recipe Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Create Recipe', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop


