<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd($category_lists, $category_l_lists);
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
    public function show($id)
    {
        $posts = Post::where('category_id', $id)->paginateget(20);
        $category = Category::where('id', $id)->first();
        foreach ($posts as $post){
            $user_id = $post->user_id;
            $user_name = User::where('id', '$user_id')->first();
            $post->user_name = $user_name; 
        }
        dd($id);
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
}
