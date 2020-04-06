@extends('layouts.app')

@section('content')
    <h1>Create a new category</h1>
    {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Category name: ')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Category Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug name: ')}}
            {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug Name'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection