<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Session;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        //Ngecek login
        $this->middleware('auth');
    }

    public function index(){
        // Fetch data dari tabel buku
        $peminjaman = DB::table('peminjaman')->get();
        $books = DB::table('books')->get();
         

    	//Ngirim data ke view
    	return view('peminjaman/index', ['books' => $books, 'peminjaman' => $peminjaman]);
    }

    public function checkDeadline(){
        $today = date('Y-m-d');
        $peminjaman = DB::table('peminjaman')->get();

        if($peminjaman->deadline < $today){
            return $peminjaman;
        }

        // foreach ($peminjaman as $p) {
        //     $deadline = $p->deadline;
        //     if($today = $deadline){
        //         return $p->id;   
        //     }

        //     else{
        //         return $peminjaman;
        //     }
        // }

    }

    public function store(Request $information)
    {
        // $peminjaman = DB::table('peminjaman')->get();
        
        // $book = DB::table('books')->where('title', $information->book_title)->first();

        // $books = $book->stock - 1;

        // $jumlah_dipinjam = $book->jumlah_dipinjam + 1;

        // $peminjaman = date('Y-m-d');

        // $id_petugas = Auth::user()->id;

        // $deadline = date('Y-m-d', strtotime($peminjaman . ' +3 day'));

        // DB::table('books')->where('title', $information->book_title)->update([
        //     'stock' => $books,
        //     'jumlah_dipinjam' => $jumlah_dipinjam
        // ]);

        // // insert data ke table buku
        // DB::table('peminjaman')->insert([
        //     'student_id' => $information->student_id,
        //     'judul_buku' => $information->book_title,
        //     'id_petugas' => $id_petugas,
        //     'tanggal_peminjaman' => $peminjaman,
        //     'deadline' => $deadline

        // ]);

        // //flash
        // Session::flash('success','Transaction has been added!');


        // // Redirect
        // return redirect('/peminjaman');

        /*
        **
        ** Ini lend nya aja
        **
        */

        $std = DB::table('siswa')->where('nis', $information->student_id)->first();
        $peminjaman = DB::table('peminjaman')->get();
        $book = DB::table('books')->where('title', $information->book_title)->first();
        
        if(isset($std)){            

            $books = $book->stock - 1;

            $jumlah_dipinjam = $book->jumlah_dipinjam + 1;

            $peminjaman = date('Y-m-d');

            $deadline = date('Y-m-d', strtotime($peminjaman . ' -1 day'));

            DB::table('books')->where('id', $information->id)->update([
                'stock' => $books,
                'jumlah_dipinjam' => $jumlah_dipinjam
            ]);

            // insert data ke table buku
            DB::table('peminjaman')->insert([
                // 'student_id' => Auth::user()->id,
                'student_id' => $information->student_id,
                'judul_buku' => $book->title,
                'id_petugas' => Auth::user()->id,
                'tanggal_peminjaman' => $peminjaman,
                'deadline' => $deadline

            ]);

            //flash
            Session::flash('success','Lend data has been added!');


            // Redirect
            return redirect('/peminjaman');
        }

        else{
            //flash
            Session::flash('danger','Siswa ga ketemu!');

            // Redirect
            return redirect('/peminjaman');
        }

    }

    public function kembalikan($id){
            $data_peminjaman = DB::table('peminjaman')->where('id', $id)->first();
            $books = DB::table('books')->where('title', $data_peminjaman->judul_buku)->first();
            $books = $books->stock + 1;
            $tanggal_kembali = date('Y-m-d');
            DB::table('books')->where('title', $data_peminjaman->judul_buku)->update([
                'stock' => $books
            ]);

            DB::table('peminjaman')->where('id', $id)->update([
                'tanggal_pengembalian' => $tanggal_kembali,
                'status' => 'Selesai'
            ]);

            //flash
            Session::flash('success','Book has been returned!');


            // Redirect
            return redirect('/peminjaman');
    }



}
