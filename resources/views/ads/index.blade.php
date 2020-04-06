@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        <a href="{{asset('/ads/create')}}" class="btn btn-default">Create a new Ad</a>
    @endif
    
    <h1>ALL Ads</h1>
    @if(count($ads) > 0)
        @foreach ($ads as $ad)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="height:200px" src="storage/main_images/{{$ad->main_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="ads/{{$ad->id}}"><b>Title: </b>{{$ad->title}}</a></h3>
                        <h4><b>Description: </b>{!! $ad->description !!}</h4>
                        <h4><b>Price: </b>{{$ad->price}}</h4>
                        <h4><b>Category: </b>{{$ad->category->title}}</h4>
                        <h4><b>City: </b>{{$ad->city->title}}</h4>
                        <h4><b>Active: </b>{{$ad->active}}</h4>
                    <small>Written on {{$ad->created_at}}. Expired on {{$ad->date_expired}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$ads->links()}}
    @else
        <p>No Ads Yet</p>
    @endif
@endsection