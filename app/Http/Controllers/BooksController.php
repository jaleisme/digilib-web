<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Student;
use Auth;
use Session;

class BooksController extends Controller
{
    //Cek login
    public function __construct()
    {
        //Ngecek login
        $this->middleware('auth');
    }

    public function index(){
        // Fetch data dari tabel buku
    	$books = DB::table('books')->get();
        $categories = DB::table('ctg')->get();

    	//Ngirim data ke view
    	return view('books/index', ['books' => $books, 'categories' => $categories]);
    }

    public function viewlists(){
        $this->middleware('checkRole:siswa');
        // Fetch data dari tabel buku
    	$books = DB::table('books')->get();

    	//Ngirim data ke view
    	return view('/books/viewlists', ['books' => $books]);
    }

    public function store(Request $information)
    {

        $file = $information->file('file');

        $namabaru = time()."_".$file->getClientOriginalName();

        $tujuan_upload = 'cover_buku';

        $file->move($tujuan_upload, $namabaru);

        // insert data ke table buku
        DB::table('books')->insert([
            'title' => $information->title,
            'author' => $information->author,
            'year' => $information->year,
            'ISBN' => $information->ISBN,
            'description' => $information->description,
            'stock' => $information->stock,
            'category' => $information->category,
            'image' => $namabaru
        ]);

        //flash
        Session::flash('success','Book has been added!');


        // Redirect
        return redirect('/books');
    }

    public function edit($id)
    {
        // fetch data by id
        $books = DB::table('books')->where('id',$id)->get();
        $categories = DB::table('ctg')->get();

    	//Ngirim data ke view
    	return view('books/edit', ['books' => $books, 'categories' => $categories]);
    
    }
    public function lend(Request $information)
    {
        $std = DB::table('siswa')->where('nis', $information->nis);

        if(isset($std)){
            $peminjaman = DB::table('peminjaman')->get();
            
            $book = DB::table('books')->where('id', $information->id)->first();

            $books = $book->stock - 1;

            $jumlah_dipinjam = $book->jumlah_dipinjam + 1;

            $peminjaman = date('Y-m-d');

            $deadline = date('Y-m-d', strtotime($peminjaman . ' +3 day'));

            DB::table('books')->where('id', $information->id)->update([
                'stock' => $books,
                'jumlah_dipinjam' => $jumlah_dipinjam
            ]);

            // insert data ke table buku
            DB::table('peminjaman')->insert([
                // 'student_id' => Auth::user()->id,
                'student_id' => $information->nis,
                'judul_buku' => $book->title,
                'id_petugas' => Auth::user()->id,
                'tanggal_peminjaman' => $peminjaman,
                'deadline' => $deadline

            ]);

            //flash
            Session::flash('success','Lend data has been added!');


            // Redirect
            return redirect('/books/viewlists');
        }

        else{
            //flash
            Session::flash('danger','Siswa ga ketemu!');
        }
    }

    public function update(Request $updated_info)
    {
        // update data buku
        DB::table('books')->where('id', $updated_info->id)->update([
            'title' => $updated_info->title,
            'author' => $updated_info->author,
            'year' => $updated_info->year,
            'ISBN' => $updated_info->ISBN,
            'description' => $updated_info->description,
            'stock' => $updated_info->stock,
            'category' => $updated_info->category
        ]);

        //flash
        Session::flash('warning','Book has been updated!');

        // Redirect
        return redirect('/books');
    }

    public function delete($id)
    {
        // menghapus data buku berdasarkan id yang dipilih
        DB::table('books')->where('id',$id)->delete();

        //flash
        Session::flash('danger','Book has been deleted!');

        // alihkan halaman ke halaman books
        return redirect('/books');
    }

    public function detail($id)
    {
        // fetch data by id
        $books = DB::table('books')->where('id',$id)->get();

        // passing data book yang didapat ke view edit.blade.php
        return view('books/detail',['books' => $books]);
    
    }

}
