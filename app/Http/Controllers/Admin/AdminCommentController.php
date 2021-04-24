<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comment', compact('comments'));
    }
    public function destroy($id)
    {
         Comment::findOrFail($id)->delete();
         Toastr::success('Comment Successfully Deleted :)', 'success');
         return redirect()->back();
    }
}
