@extends('layouts.app')

@section('content')

@if ($message = Session::get('warning'))
	<div class="alert alert-warning alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button> 
		<strong>{{ $message }}</strong>
	</div>
@endif

@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button> 
		<strong>{{ $message }}</strong>
	</div>
@endif

@if ($message = Session::get('danger'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button> 
		<strong>{{ $message }}</strong>
	</div>
@endif


	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center mb-3">
				<h1 style="font-weight: bold;">Books lists</h1>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addData">
  					Add new book
				</button>

				<!-- <a href="/books/add" class="btn btn-success">Add new book</a> -->
				<a href="/books/print" class="btn btn-primary">Export to pdf</a>
			</div>

			<div class="col-md-1"></div>
			<div class="col-md-10">

			<div class="table-responsive table-wrapper">
			<table class="table text-center">
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Author</th>
					<th>Categories</th>
					<th>ISBN</th>
					<th>Stock</th>
					<th>Jumlah Dipinjam</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th>Action</th>
				</tr>
				@foreach($books as $book)
				<tr>
					<td>{{ $book->id }}</td>
					<td><a href="/books/detail/{{ $book->id }}" class="text-success" style="font-weight: bold;">{{ $book->title }}</a></td>
					<td>{{ $book->author }}</td>
					<td>{{ $book->category }}</td>
					<td>{{ $book->ISBN }}</td>
					<td>{{ $book->stock }}</td>
					<td>{{ $book->jumlah_dipinjam }} kali</td>
					<td>{{ $book->created_at }}</td>
					<td>{{ $book->updated_at }}</td>
					<td>
						<a href="/books/edit/{{ $book->id }}" class="text-warning">Edit</a>
						|
						<a href="/books/delete/{{ $book->id }}" class="text-danger">Hapus</a>
					</td>
				</tr>
				@endforeach
			</table>
			</div>
			</div>
		</div>
	</div>


<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="/books/store" method="post" enctype="multipart/form-data">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add new book</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
      	
		  <div class="modal-body pt-4">

			{{ csrf_field() }}
			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="title" required autocomplete="">
				<label class="psn-label-input" for="title">
					<span class="psn-label-input-span">Book title</span>
				</label>
			</div>
			
			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="author" required autocomplete="">
				<label class="psn-label-input" for="author">
					<span class="psn-label-input-span">Author name</span>
				</label>
			</div>
			
			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="year" required autocomplete="">
				<label class="psn-label-input" for="year">
					<span class="psn-label-input-span">Release year</span>
				</label>
			</div>
			
			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="number" name="ISBN" required autocomplete="">
				<label class="psn-label-input" for="ISBN">
					<span class="psn-label-input-span">ISBN</span>
				</label>
			</div>
			
			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="description" required autocomplete="">
				<label class="psn-label-input" for="description">
					<span class="psn-label-input-span">Description</span>
				</label>
			</div>
			
			<br>    

			<div class="psn-field mb-3">
				<input class="psn-input" type="number" name="stock" required autocomplete="">
				<label class="psn-label-input" for="stock">
					<span class="psn-label-input-span">Stock</span>
				</label>
			</div>
   			<br>
   
			<div class="form-group">
				<select name="category" id="" class="custom-select text-success">
					@foreach( $categories as $category )
						<option value="{{ $category->category }}" name="category">{{$category->id}} - {{ $category->category}}</option>
					@endforeach
				</select>
			</div>
			<br>


			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile" name="file">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>


		</div>
		<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Submit</button>
			</form>
		</div>
    	</div>
  	</div>
</div>

@endsection