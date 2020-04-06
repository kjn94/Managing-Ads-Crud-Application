@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        <a href="{{asset('/cities/create')}}" class="btn btn-default">Create a new City</a>
    @endif
    
    <h1>ALL Cities</h1>
    @if(count($cities) > 0)
    <ul class="list-group">
        @foreach($cities as $city)
            <li class="list-group-item"><a href="cities/{{$city->id}}">{{$city->title}}</a></li>
        @endforeach
    </ul>
    @endif
@endsection