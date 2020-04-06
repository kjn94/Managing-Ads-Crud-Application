@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><center><h1>Dashboard</h1></center></div>
                @if(!Auth::guest())
                    <center><h1>You are logged in!</h1></center>
                @else
                <center>
                    <a href="{{asset('/login')}}" class="btn btn-default">Login</a>
                    <a href="{{asset('/register')}}" class="btn btn-default">Register</a>
                </center>
                @endif
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection
