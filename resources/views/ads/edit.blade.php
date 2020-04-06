@extends('layouts.app')

@section('content')
    <h1>Edit Ad</h1>
    {!! Form::open(['action' => ['AdsController@update', $ad->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $ad->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $ad->description, ['id' => 'summary-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::number('price', $ad->price, ['class' => 'form-control', 'placeholder' => 'Price'])}}
        </div>
        <div class="form-group">
            {{Form::label('date_expired', 'Date Expired')}}
            {{ Form::date('date_expired', $ad->date_expired, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{Form::label('date_created', 'Date Created')}}
            {{ Form::date('date_created', $ad->date_created, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('category_id', 'Category:') }}
            {{ Form::select('category_id', $categories, $ad->category->id, ['class' => 'form-control']) }}
        </div> 
        <div class="form-group">
            {{ Form::label('city_id', 'City:') }}
            {{ Form::select('city_id', $cities, $ad->city->id, ['class' => 'form-control']) }}
        </div> 
        <div class="form-group">
            {{ Form::label('active', 'Active/Inactive:') }}
            {{ Form::select('active', array( 0 => 'inactive', 1 => 'active'), $ad->active)}}
        </div>
        <div class="form-group">
            {{Form::file('main_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        
    {!! Form::close() !!}
@endsection