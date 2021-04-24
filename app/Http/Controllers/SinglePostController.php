<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
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

        $randomposts = Post::approved()->published()->take(3)->inRandomOrder()->get();
        return view('frontendpage/single-post', compact('post', 'randomposts'));
    }
    public function index()
    {
        $posts = Post::latest()->approved()->published()->paginate(6);
        return view('frontendpage.blog-post',compact('posts'));
    }

    public function postByCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('frontendpage/category-by-post', compact('category'));
    }
    public function postByTag(Request $request, $slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        return view('frontendpage/tag-by-post', compact('tag'));
    }
}
