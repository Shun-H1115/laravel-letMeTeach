<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Review;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

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
        $category_lists_org = Category::orderBy('category_L')->get();
        $category_lists = $category_lists_org->toArray();

        return view('posts.create', compact('user', 'category_lists'));
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
            'category_id' => ['required'],
            'comment' => ['required', 'string'],
        ]);

        $post = new Post;
        
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->comment = $request->comment;

        if($request->category_id == "10000"){
            $category = new Category;
            $category->category_L = $request->category_L;
            $category->category_S = $request->category_S;
            $category->save();
            $post->category_id = $category->id;
        }else{
            $post->category_id = $request->category_id;
        }

        $post->save();

        $post_id = $post->id;
        if($request->files!=NULL){
            $file_datas = $request->file('files');
            $count = 0;
            Storage::makeDirectory('public/file/'.$post_id);
            foreach($file_datas as $file_data){
                $file = new File;
                $file->post_id = $post_id;
                $file->extension = $file_data->extension();

                if(Storage::exists('public/file/'.$post_id.'/'.$file_data->extension())){
                    Storage::makeDirectory('public/file/'.$post_id.'/'.$file_data->extension());
                } 

                $file_data->storeAs('public/file/'.$post_id.'/'.$file_data->extension(), $count.'.'.$file_data->extension());
                $file->file_path = '/storage/file/'.$post_id.'/'.$file_data->extension().'/'.$count.'.'.$file_data->extension();
                $file->save();
                $count++;
            }            
        }       
        
        return redirect()
        ->route('categories.index')
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
        $post = Post::where('id', $id)->first();
        $user_id_p = $post->user_id;
        $user_p = User::where('id', $user_id_p)->first();
        $post->user_name = $user_p->name;
        $files = File::where('post_id', $id)->get();
        $reviews = Review::where('post_id', $id)->get()->toArray();
        $count = 0;
        foreach ($reviews as $review){
            $user_id_r = $review['user_id'];
            $user_r = User::where('id', $user_id_r)->first();
            $reviews[$count]['user_name'] = $user_r->name; 
            $count++;
        }

        $images = [];
        $movies = [];
        $voices = [];
        $count_i = 0;
        $count_m = 0;
        $count_v = 0;
        foreach ($files as $file){
            if($file->extension=='jpg' or $file->extension=='png'){
                $images[$count_i] = $file->toArray();
                $count_i++;
            }elseif($file->extension=='mp4'){
                $movies[$count_m] = $file->toArray();
                $count_m++;
            }elseif($file->extension=='mp3'){
                $voices[$count_v] = $file->toArray();
                $count_v++;
            }
            
        }
        if($reviews==[]){
            $rating_score = NULL;
            $reviews_avg = NULL;
        }else{
            $rating_score = array_column($reviews, 'rating_score');
            $reviews_avg = array_sum($rating_score) / count($rating_score);
        }
        

        return view('posts.show', compact('post', 'images', 'movies', 'voices', 'reviews', 'reviews_avg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $category_lists_org = Category::orderBy('category_L')->get();
        $category_lists = $category_lists_org->toArray();

        return view('posts.edit', compact('user', 'post', 'category_lists'));
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
