@extends('layouts.app')

@section('content')
@foreach($books as $book)

<div class="container">
<div class="row">
<div class="col-md-8">
<div class="card bg-success">
  <div class="card-body">
    <h1 class="card-title">{{ $book->title }}</h1>
    <small>by {{ $book->author }}</small><br><br>
    
    
                        Description :
                        {{ $book->description }} <br><br>

                        Release year : 
                        {{ $book->year }} <br><br>

                        ISBN :
                        {{ $book->ISBN }} <br><br>

                        Stock :
                        {{ $book->stock }} <br><br>

                        Categories :
                        {{ $book->category }} <br>    

    <a href="/books" class="btn btn-outline-warning float-right">Back</a>
  </div>
</div>
</div><div class="col-md-4"><img src="{{ url('/cover_buku/'.$book->image) }}" alt="{{ url('/cover_buku/'.$book->image) }}" style="width: 100%; border-radius: 5%;"></div>
    </div>
</div>
@endforeach
@endsection