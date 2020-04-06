@extends('layouts.app')

@section('content')
<a href="../cities" class="btn btn-default">Go Back</a>
    <h1><b>CITY Name: </b>{{$city->title}}</h1>
<br>
    @if(!Auth::guest())
        <a href="{{$city->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['CitiesController@destroy', $city->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection