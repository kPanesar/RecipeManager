@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit a Recipe</h1>
        {!! Form::model($recipe, ['method' => 'PUT', 'route' => ['recipes.update', $recipe->id], 'files' => true,]) !!}

        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('photo', 'Photo', ['class' => 'control-label']) !!}
                {!! Form::file('photo', old('photo'), ['class' => 'form-control']) !!}
                {!! Form::hidden('photo_max_size', 10) !!}
                {!! Form::hidden('photo_max_width', 2000) !!}
                {!! Form::hidden('photo_max_height', 2000) !!}
                <p class="help-block"></p>
                @if($errors->has('photo'))
                    <p class="help-block">
                        {{ $errors->first('photo') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 input-group">
                <h4>Ingredients</h4>
                @foreach($recipe->ingredients as $ingredient)
                    {{--{!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::input('number', 'quantity', $ingredient->quantity) !!}--}}

                    <div class="input-group">
                        <input type="text" name="ingredient[]" class="form-control" value="{{ $ingredient->quantity }}" />
                        <span class="input-group-addon"> </span>
                        <input type="text" name="ingredient[]" class="form-control" value="{{ $ingredient->unit }}" />
                        <span class="input-group-addon"> </span>
                        <input type="text" name="ingredient[]" class="form-control" value="{{ $ingredient->name }}" />
                    </div>
                @endforeach
            </div>
        </div>

        {{--<div id="recipe">--}}
            {{--<a id="ingredient_btn" class="btn btn-default">--}}
                {{--<p><span class="glyphicon glyphicon-plus text-red" aria-hidden="true"></span> Add an Ingredient</p>--}}
            {{--</a>--}}
            {{--<h4>Ingredients</h4>--}}
            {{--@foreach($recipe->ingredients as $ingredient)--}}
                {{--<ingredientform--}}
                        {{--quantity   = "{{ $ingredient->quantity }}"--}}
                        {{--unit       = "{{ $ingredient->unit }}"--}}
                        {{--name       = "{{ $ingredient->name }}"--}}
                {{--></ingredientform>--}}
            {{--@endforeach--}}

            {{--<br>--}}

            {{--<div class="row">--}}
                {{--<div class="col-sm-10">--}}
                    {{--<h4>Directions</h4>--}}
                {{--</div>--}}
                {{--<div class="col-sm-2">--}}
                    {{--<a id="ingredient_btn" class="btn btn-default">--}}
                        {{--<p><span class="glyphicon glyphicon-plus text-red" aria-hidden="true"></span> Add a Step</p>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--@foreach($recipe->directions as $direction)--}}
                {{--<directionform--}}
                        {{--step        = "{{ $direction->step_num }}"--}}
                        {{--direction   = "{{ $direction->direction_text }}"--}}
                {{--></directionform>--}}
            {{--@endforeach--}}

        {{--</div>--}}

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

    </div>
@stop


