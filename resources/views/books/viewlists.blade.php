@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    @foreach( $books as $book )
    @if($book->stock > 0)
    <div class="col-md-2 ml-5">
        <img src="{{ url('/cover_buku/'.$book->image) }}" alt="{{ $book->image }}" style="height: 250px; border-radius: 5%;">
        <center>
        <a href="/books/lend/{{$book->id}}" class="btn btn-primary mt-2" style="border-radius:25px;">
            Lend {{$book->title}}
        </a>
        </center>
    </div>
    @endif
    @endforeach
</div>
</div>
@endsection