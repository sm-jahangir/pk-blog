<?php

namespace App\Http\Controllers\Author;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class AuthorCommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('author.comment', compact('posts'));
    }
    public function destroy($id)
    {
        $commt = Comment::findOrFail($id);
        if ($commt->post->user->id == Auth::id()) {
            $commt->delete();
            Toastr::success('Comment Successfully Deleted :)', 'success');
        }else{
         Toastr::success('You are not Authrized to delete this comment :)', 'success');
        }
         return redirect()->back();
    }
}
