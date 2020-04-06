@extends('layouts.app')

@section('content')
    <h1>Create a new Page</h1>
    {!! Form::open(['action' => 'PagesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Page name: ')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Page Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('text', 'Text name: ')}}
            {{Form::textarea('text', '', ['id' => 'summary-ckeditor', 'class' => 'form-control', 'placeholder' => 'Text Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug name: ')}}
            {{Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'Slug Name'])}}
        </div>
        <div class="form-group">
            {{Form::file('page_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection