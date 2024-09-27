<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function update_view($id,$name,$email)
    {
        return view('update')->with(['id'=>$id,'name'=>$name,'email'=>$email]);
    }

    public function update_user(Request $request)
    {
        
        $newName = $request->input('Newname');
        $newEmail = $request->input('Newemail');
        $id = $request->input('id');

        
        $result = DB::table('_project')->where('id', $id)->update([
            'name' => $newName,
            'email' => $newEmail
        ]);

        if ($result) {
            $data = DB::table('_project')->get();
             return view('list_users', ['data' => $data]);
        } else {
            return 'Error';
        }


    }
    public function deleteUser($currentEmail)
    {
        $delete = DB::table('_project')->where('email', $currentEmail)->delete();
        
        if ($delete) {
            $data = DB::table('_project')->get();
            return view('list_users')->with (['data' => $data]);
        } else {
           return 'error';
        }
    }

        
}

