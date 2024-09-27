<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login_view(Request $request)
    {
        
        return view('login');
    }

    public function login_user(Request $request)

    {
        $email = $request->input('email');
        $password = $request->input('password');
       
        $emailexisit=DB::table('_project')->where('email', $email)->exists();
        $PasswordFromDB = DB::table('_project')->where('email', $email)->value('password');
       
       
        if($emailexisit){
           
                if ($password == $PasswordFromDB) {
                    
                    $request->session()->put('email', $emailexisit);
                    $data = DB::table('_project')->get();
                    return redirect('/list_users');
                           
                }else{
                    echo "<script>alert('password incorrect');</script>";
                    
                }
            
        }
        else{
            
            echo "<script>alert('Email not exists signup');</script>";
        }
    }
       
    
}