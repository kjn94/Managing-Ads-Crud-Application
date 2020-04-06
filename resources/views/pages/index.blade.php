@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        <a href="{{asset('/pages/create')}}" class="btn btn-default">Create a new Page</a>
    @endif
    
    <h1>ALL Pages</h1>
    @if(count($pages) > 0)
        @foreach ($pages as $page)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="height:200px" src="storage/page_images/{{$page->page_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="pages/{{$page->slug}}"><b>Title: </b>{{$page->title}}</a></h3>
                        <h4><b>Text: </b>{!! $page->text !!}</h4>
                        <h4><b>Slug: </b>{{$page->slug}}</h4>
                    <small>Written on {{$page->created_at}}. Expired on {{$page->updated_at}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Pages Yet</p>
    @endif
@endsection