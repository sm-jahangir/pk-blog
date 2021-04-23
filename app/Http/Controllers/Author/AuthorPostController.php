<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\NewAuthorPost;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AuthorPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();
        return view('author/post/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('author/post/create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
        ]);
        $post = new Post();


        $image = $request->file('image');
        $ext = $image->extension();
        $file = time(). '.'.$ext;
        $image->storeAs('public/post',$file);//above 4 line process the image code
        $post->image =  $file;//ai code ta image ke insert kore

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->user_id = Auth::id();
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id','1')->get();
        Notification::send($users, new NewAuthorPost($post));
   
        Toastr::success('Post Successfully Inserted', 'success');
        return redirect('author/post/');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post['user_id'] != Auth::id()) {
            Toastr::error('Only Admin Access this Post', 'Error');
            return redirect('author/post');
        }
        return view('author.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        if ($post['user_id'] != Auth::id()) {
            Toastr::error('Only Admin Access this Post', 'Error');
            return redirect('author/post');
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('author/post/edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
        ]);

        // Akhane post find kore id bosate hobe nah,,,karon oporer $post theke sob kaj kore dibe;

        if($request->has('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time(). '.'.$ext;
            $image->storeAs('public/post',$file);//above 4 line process the image code
            $post->image =  $file;//ai code ta image ke insert kore
        }


        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->user_id = Auth::id();
        $post->body = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
   
        Toastr::success('Post Successfully Updated', 'success');
        return redirect('author/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post['user_id'] != Auth::id()) {
            Toastr::error('Only Admin Access this Post', 'Error');
            return redirect('author/post');
        }
        $post -> categories()->detach();
        $post -> tags()->detach();
        $post -> delete();
        
        Toastr::success('Post Successfully Deleted', 'success');
        return redirect('author/post/');
    }
}
