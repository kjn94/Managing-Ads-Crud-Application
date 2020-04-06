@extends('layouts.app')

@section('content')
<a href="../ads" class="btn btn-default">Go Back</a>
@if(!Auth::guest())
    <a href="/ads/{{$ad->id}}/upload" class="btn btn-default">Upload Images</a>
@endif

    <h1><b>TITLE: </b>{{$ad->title}}</h1>
    <img style="height:200px" src="../storage/main_images/{{$ad->main_image}}">
<br><br>
<div>
    <b>Description: </b>{!! $ad->description !!}
</div>
    <hr>
<small>Written on {{$ad->created_at}}. Expired on {{$ad->date_expired}}</small>
<h4><b>Price: </b>{{$ad->price}}</h4>
<h4><b>Category: </b>{{$ad->category->title}}</h4>
<h4><b>City: </b>{{$ad->city->title}}</h4>
<h4><b>Active: </b>{{$ad->active}}</h4>
    <hr> 
    @if(count($ad->galleries) > 0)
        <h2>Gallery</h2>
        @foreach($ad->galleries as $gallery)
            <a href="photos/{{$gallery->id}}">
                <img style="height:200px" src="../storage/photos/{{$gallery->filename}}">
            </a>
        @endforeach
    @else
        <h2>No images in the gallery yet.</h2>
    @endif
    <hr>
        @if(!Auth::guest())
        <a href="{{$ad->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['AdsController@destroy', $ad->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        @endif
    @endsection