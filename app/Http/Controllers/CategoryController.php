<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin/category/index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'name'=>'required',
            'image'=>'required',
        ]);

        $category = new Category();

        $image = $request->file('image');
        $ext = $image->extension();
        $file = time(). '.'.$ext;
        $image->storeAs('public/category',$file);//above 4 line process the image code

        $category->image =  $file;//ai code ta image ke insert kore



        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        
        Toastr::success('Category Successfully Inserted :)', 'success');
        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;

        if($request->has('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time(). '.'.$ext;
            $image->storeAs('public/category',$file);//above 4 line process the image code
            $category->image =  $file;//ai code ta image ke insert kore
        }


        // if(Input::hasFile('image'))
        // {
        //     $usersImage = public_path("public/post/{$category->image}"); // get previous image from folder
        //     if (File::exists($usersImage)) { // unlink or remove previous image from folder
        //         unlink($usersImage);
        //     }
        //     $file = Input::file('image');
        //     $name = time() . '-' . $file->getClientOriginalName();
        //     $file = $file->move(('public/post'), $name);
        //     $category->image= $name;
        // }

        $category->slug = Str::slug($request->name);
        $category->save();
        
        Toastr::success('Category Successfully Updated :)', 'success');
        return redirect('admin/category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        Toastr::success('Tag Successfully Deleted :)', 'success');
        return redirect('admin/category');
    }
}
