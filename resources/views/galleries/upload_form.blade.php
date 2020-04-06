@extends('layouts.app')

@section('content')
    <h1>Upload to Gallery</h1>
    @if (count($errors) > 0)
        <ul><li>{{ $errors }}</li></ul>
    @endif
    {!! Form::open(['action' => ['GalleriesController@uploadSubmit', $ad->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{ csrf_field() }}
        
        <input multiple="multiple" name="photos[]" type="file"> 


        {{Form::submit('Upload', ['class'=> 'btn btn-primary'])}}
        
    {!! Form::close() !!}
@endsection