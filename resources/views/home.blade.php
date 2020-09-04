@extends('layouts.app')

@section('content')
<div class="container">


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="{{url('img/undraw_freelancer_b0my.svg')}}" alt="un" style="width:50%;"><br>
                                <h1 class="text-success">Welcome back, {{Auth::user()->name}}!</h1>
                                <small>Your id : {{Auth::user()->id}}</small>
                            </center>
                        </div>

                    </div>

</div>
@endsection
