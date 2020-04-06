@extends('layouts.app')

@section('content')
<a href="../pages" class="btn btn-default">Go Back</a>
    <h1><b>TITLE: </b>{{$page->title}}</h1>
<br><br>
<div>
    <h3><b>TEXT: </b>{!! $page->text !!}</h3>
    <img style="height:200px" src="../storage/page_images/{{$page->page_image}}">
    <h4><b>Slug: </b>{{$page->slug}}</h4>

</div>
    
    @if(!Auth::guest())
        <a href="{{$page->slug}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['PagesController@destroy', $page->slug], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection