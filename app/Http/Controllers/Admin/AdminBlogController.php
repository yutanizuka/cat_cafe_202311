<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\Cat;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use Illuminate\support\Facades\Auth;
use App\Models\Category;

class AdminBlogController extends Controller
{

    //ブログ一覧画面
    public function index()
    {
        //
        $user = Auth::user();
        $blogs = Blog::latest('updated_at')->paginate(10);
        return view('admin.blogs.index',['blogs' => $blogs, 'user' => $user] );

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
    public function edit(Blog $blog)
    {
        ////
        // $blog = Blog::findOrFail($id);
        $categories = Category::all();
        $cats =  Cat::all();
        return view('admin.blogs.edit',[
            'blog'       => $blog,
            'categories' => $categories,
            'cats'       => $cats
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $updateData = $request->validated();

        //画像を変更する場合
        if ($request->has('image')) {
            // 変更前の画像削除
            Storage::disk('public')->delete($blog->image);
            //変更後の画像をアップロード、保存パスを更新対象にデータセット
            $updateData['image'] = $request->file('image')->store('blogs' , 'public');
            // dd($updateData['image']);

        }
        $blog->category()->associate($updateData['category_id']);
        if ($blog->update($updateData)) {
            $blog->cats()->sync($updateData['cats'] ?? []) ;
            return redirect()->route('admin.blogs.index')->with('success','ブログを更新しました');
        } else {
            // 更新に失敗した場合の処理をここに書く
            return redirect()->back()->withInput()->withErrors('ブログの更新に失敗しました');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        Storage::disk('public')->delete($blog->image);

        return redirect()->route('admin.blogs.index')->with('success','ブログを削除しました');

    }
}
