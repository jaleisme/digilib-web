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
		<h1 style="font-weight: bold;">Siswa lists</h1>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addData">
  			Add new siswa
		</button>
		<a href="/siswa/import" class="btn btn-primary">Import from pdf</a>
	</div>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Class</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Action</th>
					</tr>
					@foreach($siswa as $s)
					<tr>
						<td>{{$s->id}}</td>
						<td>{{$s->nama}}</td>
						<td>{{$s->kelas}}</td>
						<td>{{$s->created_at}}</td>
						<td>{{$s->updated_at}}</td>
						<td><a href="siswa/edit" class="text-warning">Edit</a> | <a href="siswa/delete/{{$s->id}}" class="text-danger">Delete</a></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<form action="/siswa/store" method="post">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add new siswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
      	
		  <div class="modal-body pt-4">

			{{ csrf_field() }}
			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="nama" required autocomplete="">
				<label class="psn-label-input" for="nama">
					<span class="psn-label-input-span">Name</span>
				</label>
			</div>
   			<br>
   
			<div class="psn-field mb-3">
				<input class="psn-input" type="text" name="kelas" required autocomplete="">
				<label class="psn-label-input" for="kelas">
					<span class="psn-label-input-span">Class</span>
				</label>
			</div>
   			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="email" name="email" required autocomplete="">
				<label class="psn-label-input" for="email">
					<span class="psn-label-input-span">Email</span>
				</label>
			</div>
   			<br>

			<div class="psn-field mb-3">
				<input class="psn-input" type="number" name="nis" required autocomplete="">
				<label class="psn-label-input" for="nis">
					<span class="psn-label-input-span">NIS</span>
				</label>
			</div>
   			<br>

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