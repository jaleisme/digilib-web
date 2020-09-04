<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Student;

class MobaController extends Controller
{
    /*
    *
    * Function to request and Process Sign In on Mobile devices
    *
    */
    public function signin(Request $info){
        try {
            $student = Student::where('nis', $info->Nis)->where('password', $info->Password)->first();
            return response()->json([

                'message' => 'Login Berhasil!',
                'serve' => $student

            ], 200);

        } catch (Exception $errmsg) {

            return response()->json([

                'message' => 'Yahh Gagal',
                'serve' => []

            ], 500);   
        }
    }

    /*
    **
    ** Function to give response and display books on Mobile devices
    **
    */
    public function home(){
        
    }

}
