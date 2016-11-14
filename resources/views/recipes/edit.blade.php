@extends('layouts.app')

@section('content')
    <div id="recipe" class="container">
        <recipe :recipe="{{ $recipe }}"></recipe>
    </div>
@stop


