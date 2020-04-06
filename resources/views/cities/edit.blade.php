@extends('layouts.app')

@section('content')
<h1>Edit {{$city->title}}</h1>
    {!! Form::open(['action' => ['CitiesController@update', $city->id], 'method' => 'POST']) !!}
    @csrf

    <div class="form-group">
            {{Form::label('title', 'City name: ')}}
            {{Form::text('title', $city->title, ['class' => 'form-control', 'placeholder' => 'City Name'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection