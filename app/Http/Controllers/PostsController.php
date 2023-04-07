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
    public function index(Request $request)
    {
        $category_lists_org = Category::orderBy('category_L')->get();
        $category_lists = $category_lists_org->toArray();
        $category_l_lists_org = array_column($category_lists, 'category_L');
        $category_l_lists_unis = array_unique($category_l_lists_org);
        $count = 0;
        foreach($category_l_lists_unis as $key => $value){
            $category_l_lists[$count][0] = $key;
            $category_l_lists[$count][1] = $value;
            $count++;
        }
        $category_l_lists[$count][0] = count($category_lists);
        $num_l = count($category_l_lists)-1;


        $posts = Post::availableItems()
            ->selectCategory($request->category ?? '0')
            ->searchKeyword($request->keyword)
            ->get()->toArray();

        $count=0;
        $img_files=[];
        foreach ($posts as $post){
            $user_id = $post['user_id'];
            $user = User::where('id', $user_id)->first();
            $posts[$count]['user_name'] = $user->name; 

            $post_id = $post['id'];
            $orThose = ['extension' => 'png', 'extension' => 'jpg'];
            $img_file = File::where('post_id', $post_id)->Where($orThose)->first();
            // $posts[$count]['file_path'] = $img_file->file_path;
            if ($img_file == NULL){
                $posts[$count] = NULL;
            }else{
                $posts[$count] = $file->toArray();
            }
            $count++;
        }
        
        return view('posts.index', compact('category_l_lists', 'category_lists', 'num_l', 'posts'));
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

        if($request->category_id == "0"){
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
        $file_datas = $request->file('files');
        if($file_datas!=NULL){
            
            // Storage::makeDirectory('/file/'.$post_id);
            foreach($file_datas as $file_data){
                $file = new File;
                $file->post_id = $post_id;
                $file->extension = $file_data->extension();

                // if(Storage::exists('public/file/'.$post_id.'/'.$file_data->extension())){
                //     Storage::makeDirectory('public/file/'.$post_id.'/'.$file_data->extension());
                // } 

                // $file_data->storeAs('public/file/'.$post_id.'/'.$file_data->extension(), $count.'.'.$file_data->extension());
                $file_path = Storage::disk('s3')->putFile('/file/'.$post_id.'/'.$file_data->extension(), $file_data, 'public');
                $file->file_path = Storage::disk('s3')->url($file_path);
                $file->save();
                
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
        
        $user = Auth::user();
        
        return view('posts.show', compact('post', 'user', 'images', 'movies', 'voices', 'reviews', 'reviews_avg'));
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
            
            // Storage::makeDirectory('public/file/'.$post_id);
            foreach($file_datas as $file_data){
                $file = new File;
                $file->extension = $file_data->extension();

                // if(Storage::exists('public/file/'.$post_id.'/'.$file_data->extension())){
                //     Storage::makeDirectory('public/file/'.$post_id.'/'.$file_data->extension());
                // } 

                $file_path = Storage::disk('s3')->putFile('/file/'.$post_id.'/'.$file_data->extension(), $file_data, 'public');
                $file->file_path = Storage::disk('s3')->url($file_path);
                // $file_data->storeAs('public/file/'.$post_id.'/'.$file_data->extension(), $count.$file_data->extension());
                // $file->file_path = 'storage/file/'.$post_id.'/'.$file_data->extension().$count.$file_data->extension();
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
        dd('削除');

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'アウトプットを削除しました。',
        'status' => 'alert']);
    }

    public function ranking()
    {
        $reviews = Review::all()->toArray();
        $reviews_post_ids = array_column($reviews, 'post_id');
        $reviews_post_id_list = array_unique($reviews_post_ids);
        $rankings = [[]];
        foreach ($reviews_post_id_list as $reviews_post_id){
            $review_clip = Review::where('post_id', $reviews_post_id)->get()->toArray();
            $rating_scores = array_column($review_clip, 'rating_score');
            $rating_score_avg = array_sum($rating_scores) / count($rating_scores);
            $ranking = Post::where('id', $reviews_post_id)->first()->toArray();
            $ranking['rating_score'] = $rating_score_avg;
            $user = User::where('id', $ranking['user_id'])->first()->toArray();
            $ranking['user_name'] = $user['name'];
            $rankings[] = $ranking;
        }

        array_shift($rankings);
        array_multisort(array_column($rankings, 'rating_score'), SORT_DESC, $rankings);

        $count = min(5, count($reviews_post_id_list));
        for ($i=0; $i<$count; $i++){
            $rankings[$i]['rank'] = $i+1;
        }
        
        return view('posts.ranking', compact('rankings'));

    }
}
