<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;

class SiswaController extends Controller
{
    //Cek login
    public function __construct()
    {
        //Ngecek login
        $this->middleware('auth');
        $this->middleware('checkRole:admin');
    }

    public function index(){
        // Fetch data dari tabel buku
    	$siswa = DB::table('siswa')->get();
 
    	//Ngirim data ke view
    	return view('siswa/index',['siswa' => $siswa]);
    }

    public function add(){
        //Redirect ke view
        return view('siswa/add');
    }

    public function store(Request $information)
    {
        // $user = new \App\User;
        // $user->role = 'siswa';
        // $user->name = $information->nama;
        // $user->password = bcrypt("GOBLOK!");
        // $user->email = $information->email;
        // $user->remember_token = str_random(60);
        // $user->save();


        DB::table('siswa')->insert([    
            'id' => Helper::randString(),
            'nama' => $information->nama,
            'kelas' => $information->kelas,
            'email' => $information->email,
            'nis' => $information->nis,
            'password' => Helper::randPassword()
            // 'user_id' => $user->id
        ]);

        Session::flash('success','Siswa has been added!');

        // Redirect
        return redirect('/siswa');
    }

    public function edit($id)
    {
        // fetch data by id
        $siswa = DB::table('siswa')->where('id',$id)->get();

        // passing data book yang didapat ke view edit.blade.php
        return view('siswa/edit',['siswa' => $siswa]);
    
    }

    public function update(Request $updated_info)
    {
        // update data buku
        DB::table('siswa')->where('id', $updated_info->id)->update([
            'nama' => $updated_info->nama,
            'kelas' => $updated_info->kelas
        ]);

        //Flash
        Session::flash('success','Siswa has been updated!');

        // Redirect
        return redirect('/siswa');
    }

    public function delete($id)
    {
        // menghapus data siswa berdasarkan id yang dipilih
        DB::table('siswa')->where('id',$id)->delete();

        //flash
        Session::flash('danger','Siswa has been deleted!');

        // alihkan halaman ke halaman siswa
        return redirect('/siswa');
    }


}
