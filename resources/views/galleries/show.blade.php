@extends('layouts.app')

@section('content')
    <a href="../{{$gallery->ad_id}}" class="btn btn-default">Go Back</a><br>
    <img style="height:300px" src="../../storage/photos/{{$gallery->filename}}">  
    @if(!Auth::guest())
    {!! Form::open(['action' => ['GalleriesController@destroy', $gallery->id], 'method' => 'POST']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete Photo', ['class' => 'button danger'])}}
    {!! Form::close() !!}
    @endif
    @endsection