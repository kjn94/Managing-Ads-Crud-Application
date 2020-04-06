@extends('layouts.app')

@section('content')
    <h1>Create a new city</h1>
    {!! Form::open(['action' => 'CitiesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'City name: ')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'City Name'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection