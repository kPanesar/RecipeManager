@extends('layouts.app')

@section('content')
    <div id="recipe" class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Edit a Recipe</h1>
                <recipe :recipe="{{ $recipe }}"></recipe>
            </div>
        </div>
    </div>
@stop


