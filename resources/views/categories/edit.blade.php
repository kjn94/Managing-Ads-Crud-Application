@extends('layouts.app')

@section('content')
<h1>Edit {{$category->title}} category</h1>
    {!! Form::open(['action' => ['CategoriesController@update', $category->slug], 'method' => 'POST']) !!}
    @csrf

    <div class="form-group">
            {{Form::label('title', 'Category name: ')}}
            {{Form::text('title', $category->title, ['class' => 'form-control', 'placeholder' => 'Category Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug name: ')}}
            {{Form::text('slug', $category->slug, ['class' => 'form-control', 'placeholder' => 'Slug Name'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection