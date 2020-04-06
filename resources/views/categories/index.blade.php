@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        <a href="{{asset('/categories/create')}}" class="btn btn-default">Create a new Category</a>
    @endif
    
    <h1>ALL Categories</h1>
    @if(count($categories) > 0)
    <ul class="list-group">
        @foreach($categories as $category)
            <li class="list-group-item"><a href="categories/{{$category->slug}}">{{$category->title}}</a></li>
        @endforeach
    </ul>
    @endif
@endsection