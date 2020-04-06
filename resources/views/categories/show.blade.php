@extends('layouts.app')

@section('content')
<a href="../categories" class="btn btn-default">Go Back</a>
    <h1><b>Title: </b>{{$category->title}}</h1>
<br><br>
<div>
    <h3><b>Category Slug: </b>{!! $category->slug !!}</h3> 

</div>
    
    @if(!Auth::guest())
        <a href="{{$category->slug}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action' => ['CategoriesController@destroy', $category->slug], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection