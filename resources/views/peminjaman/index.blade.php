@extends('layouts.app')

@section('content')
<div class="container">


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


		<div class="row">
			<div class="col-md-12 text-center mb-3">
				<h1 style="font-weight: bold;">Books Borrowing lists</h1>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addData">
  					Add new transaction
				</button>

				<!-- <a href="/books/add" class="btn btn-success">Add new book</a> -->
				<a href="/peminjaman/print" class="btn btn-primary">Export to pdf</a>
			</div>

			<div class="col-md-1"></div>
			<div class="col-md-10">

			<div class="table-responsive table-wrapper">
			<table class="table text-center">
				<tr>
					<th>ID</th>
					<th>Student ID</th>
					<th>Book Title</th>
					<th>Admin ID</th>
					<th>Check in</th>
					<th>Deadline</th>
					<th>Tanggal Pengembalian</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
				@foreach($peminjaman as $datum)
				<tr>
					<td>{{ $datum->id }}</td>
					<td>{{ $datum->student_id }}</td>
					<td>{{ $datum->judul_buku }}</td>
					<td>{{ $datum->id_petugas }}</td>
					<td>{{ $datum->tanggal_peminjaman }}</td>
					<td>{{ $datum->deadline }}</td>
					<td>{{ $datum->tanggal_pengembalian }}</td>
					<td>{{ $datum->status }}</td>
					<td>

						@if($datum->status != "Selesai")
							<a href="/peminjaman/kembalikan/{{ $datum->id }}" class="btn btn-sm btn-outline-warning">Kembalikan</a>
						@endif

						@if($datum->status = "Selesai")
							-
						@endif

					</td>
				</tr>
				@endforeach
			</table>
			</div>
			</div>
		</div>
	</div>


<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="/peminjaman/store" method="post" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
      
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <div class="modal-body pt-4">
                
                    {{ csrf_field() }}

                    <div class="psn-field mb-3">
                        <input class="psn-input" type="number" name="student_id" required autocomplete="">
                        <label class="psn-label-input" for="student_id">
                            <span class="psn-label-input-span">Student ID</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <select name="book_title" id="" class="custom-select text-success">
                            <option>Select books</option>
                            @foreach( $books as $book )
								@if($book->stock > 0 || $book->stock = 0)
                                	<option value="{{ $book->title }}" name="book">{{$book->id}}. {{ $book->title}}</option>
								@endif
                            @endforeach
                        </select>
                    </div>

                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>



@endsection