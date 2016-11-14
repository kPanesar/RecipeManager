@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="recipe" class="container">
            <recipe :recipe="{{ $recipe }}"></recipe>
        </div>
    </div>
@stop


