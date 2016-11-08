@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            {{--<button id="ajax_btn" type="button" class="btn btn-default" aria-label="AJAX">--}}
                {{--<span class="glyphicon glyphicon-bitcoin text-red" aria-hidden="true"></span>--}}
                {{--<p>AJAX Request!</p>--}}
                {{--<div id="content">--}}
                {{--</div>--}}
            {{--</button>--}}

            @for($index = 0; $index < 1; $index++)
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <a href="{{ route('recipes.create') }}" class="btn btn-default create-recipe">
                        <span class="glyphicon glyphicon-plus text-red" aria-hidden="true"></span>
                        <p>Create Recipe</p>
                    </a>
                </div>
            @endfor

            @if (count($recipes) > 0)
                @foreach ($recipes as $recipe)
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <a href="{{ route('recipes.show', [$recipe->id]) }}" class="btn btn-default recipe">
                            <div>
                                @if($recipe->photo != '')
                                    <img src="{{ asset('uploads/thumb/'.$recipe->photo) }}">
                                @else
                                    <img src="{{asset('images/red-cake.jpg')}}" alt="Red Cake">
                                @endif
                            </div>
                            <h3 class="text-left">{{$recipe->name}}</h3>
                        </a>
                    </div>
                @endforeach
            @else
                <h2>Yo you got no recipes. Maybe you should make one...</h2>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{--<script>--}}
        {{--$('#ajax_btn').click(loadAJAX);--}}
        {{--function loadAJAX(){--}}
            {{--$('#content').html('Some AJAX shiz!');--}}
        {{--}--}}
    {{--</script>--}}
@stop


