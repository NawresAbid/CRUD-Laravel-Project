<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_view(Request $request)
    {
        return view('register');
    }

    public function save_user(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');
        $image = $request->file('image');

        // Check if email already exists
        $existingUser = DB::table('_project')->where('email', $email)->first();

        if ($existingUser) {
            // Email already exists, return an error response or handle it as needed
            return response()->json(['error' => 'Email already exists'], 409);
        }

        // Hash the password before storing it
        //$hashedPassword = Hash::make($password);
        $path = null;
            if ($image) {
                $path = $image->store('images', 'public');
            }

        $data = [
            'email' => $email,
            'name' => $name,
            'password' => $password, // Hash the password
            'image' => $path
        ];
            
        try {
           
            DB::table('_project')->insert($data);
            
          

        } catch (\Exception $e) {
          
            return response()->json(['error' => 'An error occurred while saving the user'], 500);

        }
        
       return redirect('/login_view');
    }
}


