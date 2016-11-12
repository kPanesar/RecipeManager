@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['url' => 'recipes']) !!}
        <div class="row">
            <div class="colxs-12">
                <h1>Create a Recipe</h1>
                <div class="form-group">
                    {!! Form::label('name', 'Recipe Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 input-group">
                <span>
                    <h4>Ingredients <button class="btn btn-default pull-right">
                        Add
                    </button></h4>
                </span>
                <div class="input-group">
                    <input type="text" name="ingredient[]" class="form-control" />
                    <span class="input-group-addon"> </span>
                    <input type="text" name="ingredient[]" class="form-control" />
                    <span class="input-group-addon"> </span>
                    <input type="text" name="ingredient[]" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {!! Form::submit('Create Recipe', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop


