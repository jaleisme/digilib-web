<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit siswa information</title>
</head>
<body>
    <h1>Edit siswa information</h1>

    <a href="/siswa"> Kembali</a>
	
	<br/>
	<br/>

	@foreach($siswa as $s)
	<form action="/siswa/update" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $s->id }}"> <br/>
        Nama <input type="text" name="nama" value="{{ $s->nama }}" required="required"> <br/>
        Kelas <input type="text" name="kelas" value="{{ $s->kelas }}" required="required"> <br/>
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
</body>
</html>