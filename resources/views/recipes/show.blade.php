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
            <button class="btn btn-default" v-on:click="printConsole">Click Me</button>
            <h1 class="edit_text">{{$recipe->name}}</h1>
            <p>{{$recipe->description}}</p>

            <br>

            <ingredients :ingredients="{{ $recipe->ingredients }}"></ingredients>

            <br>

            <directions :directions="{{ $recipe->directions }}"></directions>

            {{--<div>--}}
                {{--<button class="btn btn-danger" v-on:click="addSomething">Add Something</button>--}}
                {{--<input v-model="recipes">--}}
                {{--<br>--}}
                {{--<myrecipe :recipes="recipes"></myrecipe>--}}
            {{--</div>--}}
            <input
                    v-model="newTodoText"
                    v-on:keyup.enter="addNewTodo"
                    placeholder="Add a todo"
            >
            <ul>
                <mytodo
                        v-for="(todo, index) in todos"
                        :todo="todo"
                        v-on:remove="todos.splice(index, 1)">
                </mytodo>
            </ul>

        </div>
    </div>
@stop


