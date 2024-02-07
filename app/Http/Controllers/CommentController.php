<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //

    public function save(Request $request,$id){

        $validate = $this->validate($request,[
            'content' => ['required', 'string', 'max:255', 'min:3']
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::user()->id;
        $comment->image_id = $id;
        $comment->content = $request->input('content');
        $comment->save();
        
        return redirect()->route('image.detail', ['id' => $id]);
        
    }

    public function delete($id){
        $comment = Comment::find($id);
        $image_id = $comment->image_id;
        if (\Auth::user()->id != $comment->user_id) {
            return redirect()->route('image.detail', ['id' => $image_id]);
        }
        $comment->delete();
        return redirect()->route('image.detail', ['id' => $image_id]);
    }
}
