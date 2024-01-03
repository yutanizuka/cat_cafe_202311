<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\Admin\StoreBlogRequest;




class AdminBlogController extends Controller
{

    //ブログ一覧画面
    public function index()
    {
        //
        $blogs = Blog::all();
        return view('admin.blogs.index',['blogs' => $blogs] );

    }

    // ブログ投稿画面
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // ブログ投稿機能
    public function store(StoreBlogRequest $request)
{
    $savedImagePath = $request->file('image')->store('blogs','public');
    $blog = new Blog($request->validated());
    $blog->image = $savedImagePath;
    $blog->save();

    return redirect()->route('admin.blogs.index')->with('success','ブログを投稿しました。');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        ////
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', ['blog' => $blog]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
