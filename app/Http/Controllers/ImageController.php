<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use App\Models\Image;

use App\Models\Comment;
use App\Models\Like;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

        return view('image.create');
    }

    public function save(Request $request)
    {



        $validate = $this->validate($request, [
            'image_path' => ['required', 'image', 'max:10240'],
            'description' => ['required', 'string', 'max:255', 'min:3']
        ]);
        $file = $request->file('image_path');
        if (!$file) {
            return redirect()->route('image.create')->with(['error', 'No se subio ninguna imagen.']);
        }

        $image = new Image();
        $image->description = $request->input('description');
        $image->user_id = \Auth::user()->id;
        if ($file) {
            $filename = time() . $file->getClientOriginalName();
            $saveImage = Storage::disk('images')->put($filename, File::get($file));
            if (!$saveImage) {
                return redirect()->route('image.create')->with(['error', 'Hubo un problema al guardar la imagen.']);
            }
            $image->image_path = $filename;
        }

        $image->save();


        return redirect()->route('home')->with([
            'message' => 'La imagen se ha subido correctamente'
        ]);





    }


    public function getImage($filename)
    {

        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id)
    {

        $image = Image::find($id);
        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();

        $image = Image::find($id);
        if (!$image || ($user->id !== $image->user_id && $user->role !== 'admin')) {
            return redirect()->route('home');
        } else {
            $comments = Comment::where('image_id', $image->id)->get();
            $likes = Like::where('image_id', $image->id)->get();


            if ($comments && $comments->count() > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            if ($likes && $likes->count() > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }



            $delete = $image->delete();
            if ($delete) {
                Storage::disk('images')->delete($image->image_path);
            }
            return redirect()->route('home');
        }
    }

    public function edit($id){

        $user = \Auth::user();
        $image = Image::find($id);
        if(!$image || ($user->id !== $image->user_id && $user->role !== 'admin')){
            return redirect()->route('home');
        } else {
            return view('image.edit', [
                'image' => $image
            ]);
            
        }
    }

    public function update(Request $request, $id){

        $validate = $this->validate($request, [
            'description' => ['required', 'string', 'max:255', 'min:3']
        ]);
        $image = Image::find($id);
        $image->description = $request->input('description');
        $image->save();
        return redirect()->route('image.detail', ['id' => $image->id]);
    }



}
