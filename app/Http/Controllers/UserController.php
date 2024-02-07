<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use App\Models\Like;

use App\Models\User;

class UserController extends Controller
{
    // perminte que solo usuarios autenticados puedan ver esta vista
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function users($search = null){
        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('nick', 'like', "%$search%")
                      ->orWhere('name', 'like', "%$search%");
            })->where('role', '<>', 'admin')->orderBy('id', 'desc')->paginate(5);
        } else {
            $users = User::where('role', '<>', 'admin')->orderBy('id', 'desc')->paginate(5);
            
        }

        return view('user.index', ['users' => $users]);
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        $user = \Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255','unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nick = $request->input('nick');
        $user->email = $request->input('email');


        // subir imagen

        $image_path = $request->file('image_path');

        if ($image_path){
            $image_path_full = time().$image_path->getClientOriginalName();

            Storage::disk('users')->put($image_path_full, File::get($image_path));

            $user->image = $image_path_full;

        }



        $user->update();

        return redirect()->route('config')->with(['message' => 'Usuario actualizado correctamente']);

        
    }

    public function getImage($filename){

        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function like(){
        $user = \Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        

        return view('user.likes', ['likes' => $likes]);
    }

    public function profile(){

        $user = \Auth::user();

        return view('user.profile')->with('user', $user);
    }

    public function profiles($nickname){
        $user = User::where('nick', $nickname)->first();
    
        return view('user.profile')->with('user', $user);
    }

    
}
