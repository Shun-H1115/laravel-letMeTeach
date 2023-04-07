<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $user = Auth::user();
        $num_l = count($category_l_lists)-1;
        
        return view('categories.index', compact('category_l_lists', 'category_lists', 'num_l', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $posts = Post::where('category_id', $id)->get()->toArray();
        $category = Category::where('id', $id)->first();

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
                $posts[$count]['file_path'] = NULL;
            }else{
                $posts[$count]['file_path'] = $this->GetPresignedURL($img_file->image_path);
            }
            $count++;
        }
        
        return view('categories.show', compact('posts', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GetPresignedURL(string $s3_key){
        $s3 = Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $command = $client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $s3_key,
        ]);
        $request = $client->createPresignedRequest($command, "+10 minutes");

        return (string) $request->getUri();
    }
}
