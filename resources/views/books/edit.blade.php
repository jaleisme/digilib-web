@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-weight: bold;">Edit book information</h1>

	@foreach($books as $book)
	<form action="/books/update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $book->id }}"> <br/>

        <div class="psn-field mb-3">
            <input class="psn-input" type="text" name="title"  value="{{ $book->title }}" required="required">
            <label class="psn-label-input" for="title">
                <span class="psn-label-input-span">Books title</span>
            </label>
        </div>

        <div class="psn-field mb-3">
            <input class="psn-input" type="text" name="author"  value="{{ $book->author }}" required="required">
            <label class="psn-label-input" for="author">
                <span class="psn-label-input-span">Author name</span>
            </label>
        </div>
        
        <div class="psn-field mb-3">
            <input class="psn-input" type="number" name="year"  value="{{ $book->year }}" required="required">
            <label class="psn-label-input" for="year">
                <span class="psn-label-input-span">Release year</span>
            </label>
        </div>
        
        <div class="psn-field mb-3">
            <input class="psn-input" type="number" name="ISBN"  value="{{ $book->ISBN }}" required="required">
            <label class="psn-label-input" for="ISBN">
                <span class="psn-label-input-span">ISBN</span>
            </label>
        </div>

        <div class="psn-field mb-3">
            <input class="psn-input" type="text" name="description"  value="{{ $book->description }}" required="required">
            <label class="psn-label-input" for="description">
                <span class="psn-label-input-span">Book description</span>
            </label>
        </div>

        <div class="psn-field mb-3">
            <input class="psn-input" type="text" name="stock"  value="{{ $book->stock }}" required="required">
            <label class="psn-label-input" for="stock">
                <span class="psn-label-input-span">Book stock</span>
            </label>
        </div>

        <div class="form-group">
   		<select name="category" id="" class="custom-select text-success">
           <option value="{{ $book->category }}" name="category" class="text-success">{{ $book->category }}</option>
			@foreach( $categories as $category )
				<option value="{{ $category->category }}" name="category" class="text-success">{{$category->id}} - {{ $category->category}}</option>
			@endforeach
   		</select>
   	</div>

    <div class="custom-file">
		<input type="file" class="custom-file-input" id="customFile" name="file" value="{{ $book->image }}">
		<label class="custom-file-label" for="customFile">Choose file</label>
	</div>



		<button type="submit" class="btn btn-success float-right">Save changes</button>
        <a href="/books" class="btn btn-secondary float-right mr-2">Back to list</a>
	</form>
	@endforeach
@endsection
            </div>
        </div>
    </div>