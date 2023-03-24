<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $category_lists = Category::all()->toArray();
        $category_l_lists_org = array_column($category_lists, 'category_L');
        $category_l_lists_unis = array_unique($category_l_lists_org);
        $count = 0;
        foreach($category_l_lists_unis as $key => $value){
            $category_l_lists[$count][0] = $key;
            $category_l_lists[$count][1] = $value;
            $count++;
        }
        $category_l_lists[$count][0] = count($category_lists);

        return view('posts.create', compact('user', 'category_lists', 'category_l_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
        ]);

        $post = new Post;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->comment = $request->comment;
        $post->save();

        $post_id = $post->id;
        if($request->files){
            $file_datas = $request->files;
            $count = 0;
            Storage::makeDirectory('public/file/'.$post_id);
            foreach($file_datas as $file_data){
                $file = new File;
                $file->extension = $file_data->extension();

                if(Storage::exists('public/file/'.$post_id.'/'.$file_data->extension())){
                    Storage::makeDirectory('public/file/'.$post_id.'/'.$file_data->extension());
                } 

                $file_data->storeAs('public/file/'.$post_id.'/'.$file_data->extension(), $count.$file_data->extension());
                $file->file_path = 'storage/file/'.$post_id.'/'.$file_data->extension().$count.$file_data->extension();
                $file->save();
            }            
        }       

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'アウトプットを投稿しました。',
        'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->comment = $request->comment;
        $post->save();

        $post_id_new = $post->id;
        if($request->files){
            $file_datas = $request->files;
            $count = 0;
            Storage::makeDirectory('public/file/'.$post_id);
            foreach($file_datas as $file_data){
                $file = new File;
                $file->extension = $file_data->extension();

                if(Storage::exists('public/file/'.$post_id.'/'.$file_data->extension())){
                    Storage::makeDirectory('public/file/'.$post_id.'/'.$file_data->extension());
                } 

                $file_data->storeAs('public/file/'.$post_id.'/'.$file_data->extension(), $count.$file_data->extension());
                $file->file_path = 'storage/file/'.$post_id.'/'.$file_data->extension().$count.$file_data->extension();
                $file->save();
            }            
        }       

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'アウトプットを更新しました。',
        'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'アウトプットを削除しました。',
        'status' => 'alert']);
    }
}
