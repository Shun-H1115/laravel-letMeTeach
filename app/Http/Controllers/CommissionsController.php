<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionsController extends Controller
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

        return view('commissions.create', compact('user', 'category_lists'));
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

        $commission = new Commission;
        $commission->user_id = $request->user_id;
        $commission->title = $request->title;
        $commission->comment = $request->comment;       

        if($request->category_id == "10000"){
            $category = new Category;
            $category->category_L = $request->category_L;
            $category->category_S = $request->category_S;
            $category->save();
            $commission->category_id = $category->id;
        }else{
            $commission->category_id = $request->category_id;
        }

        $commission->save();

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'リクエストを投稿しました。',
        'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        $user = Auth::user();
        $commission_edit = Commission::findOrFail($commission);
        $category_lists_org = Category::orderBy('category_L')->get();
        $category_lists = $category_lists_org->toArray();
        return view('commissions.edit', compact('user', 'commission_edit', 'category_lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commission)
    {
        $commission_update = Commission::findOrFail($commission);

        $commission_update->title = $request->title;
        $commission_update->comment = $request->comment;
        $commission_update->save();

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'リクエストを更新しました。',
        'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy($commission)
    {
        Commission::findOrFail($commission)->delete();

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'リクエストを削除しました。',
        'status' => 'alert']);
    }
}
