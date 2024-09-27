<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class Liste_UserController extends Controller
{
    

    public function listUsers(Request $request)
    {
       
        $query = $request->input('query');
        if ($query) {
            // Perform search if query parameter is present
            $results = DB::table('_project')
                        ->where('name', 'LIKE', "%$query%")
                        ->orWhere('email', 'LIKE', "%$query%")
                        ->get();

            if ($results->isNotEmpty()) {
                // If results found, return filtered data to view
                $data = $results;
                return response()->json($data);
            } else {
                // If no results found, return all data
                $data = DB::table('_project')->get();
            }
        } else {
            // If no query parameter, return all data
            $data = DB::table('_project')->get();
        }

        return view('list_users')->with(['data' => $data]);
    }
        public function add_user(Request $request)
        {
            // Récupérer les données du formulaire
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $image = $request->file('image');

            // Hasher le mot de passe
            $hashedPassword = Hash::make($password);

            // Stocker le chemin de l'image
            $path = null;
            if ($image) {
                $path = $image->store('images', 'public');
            }

            
            $add = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'image' => $path, // Stocker le chemin de l'image (peut être null si aucune image)
            ];

            try {
                $inserted = DB::table('_project')->insert($add);
        
                if ($inserted) {
                    $data = DB::table('_project')->get();
                    return Response::json(['success' => true, 'message' => 'User added successfully', 'data' => $data]);
                } else {
                    return Response::json(['success' => false, 'message' => 'Failed to add user'], 500);
                }
            } catch (\Exception $e) {
                return Response::json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }
        
        public function logout(Request $request)
        {
            Auth::logout(); 
            $request->session()->invalidate(); 
            $request->session()->regenerateToken(); 
            return redirect('/login_view');
        }
  
       
 }
            
   


        


