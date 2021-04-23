<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin/post/index', compact('posts'));
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
        return view('admin/post/add', compact('categories','tags'));
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)
                        ->notify(new NewPostNotify($post));
        }

        Toastr::success('Post Successfully Inserted', 'success');
        return redirect('admin/post/');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin/post/edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
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
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
   
        Toastr::success('Post Successfully Updated', 'success');
        return redirect('admin/post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post -> categories()->detach();
        $post -> tags()->detach();
        $post -> delete();
        
        Toastr::success('Post Successfully Deleted', 'success');
        return redirect('admin/post/');
    }
    public function approval($id)
    {
        
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved =  true;
            $post->save();
            $post->user->notify(new AuthorPostApproved($post));

            
            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                Notification::route('mail', $subscriber->email)
                            ->notify(new NewPostNotify($post));
            }

            Toastr::success('Post Successfully Approved :)', 'success');
        } else {
            Toastr::info('This post is already Approved :)', 'Info');
        }
        
        return redirect('admin/post');
    }
    public function pending($id)
    {
        $post = Post::find($id);
        $post->is_approved =  false;
        $post->save();
        
        Toastr::success('Post Successfully Pending :)', 'success');
        return redirect('admin/post');
    }
}
