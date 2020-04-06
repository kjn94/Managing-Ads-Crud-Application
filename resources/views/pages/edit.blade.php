@extends('layouts.app')

@section('content')
<h1>Edit {{$page->title}}</h1>
    {!! Form::open(['action' => ['PagesController@update', $page->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
   

    <div class="form-group">
        {{Form::label('title', 'Page name: ')}}
        {{Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => 'Page Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('text', 'Text: ')}}
        {{Form::textarea('text', $page->text, ['id' => 'summary-ckeditor', 'class' => 'form-control', 'placeholder' => 'Text'])}}
    </div>
    <div class="form-group">
        {{Form::label('slug', 'Slug name: ')}}
        {{Form::text('slug', $page->slug, ['class' => 'form-control', 'placeholder' => 'Slug Name'])}}
    </div>
    <div class="form-group">
        {{Form::file('page_image')}}
    </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection