<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add siswa</title>
</head>
<body>
<h1>Siswa Information</h1>
 
 <a href="/siswa">Back</a>
 
 <br/>
 <br/>

 <form action="/siswa/store" method="post">

     {{ csrf_field() }}
     Nama <input type="text" name="nama" required="required"> <br/>
     Kelas <input type="text" name="kelas" required="required"> <br/>
     <button type="submit">Submit</button>

 </form>

</body>
</html>