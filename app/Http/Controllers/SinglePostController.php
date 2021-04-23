<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SinglePostController extends Controller
{
    public function details($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        $randomposts = Post::all()->random(3);
        return view('frontendpage/single-post', compact('post', 'randomposts'));
    }
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('frontendpage.blog-post',compact('posts'));
    }
}
