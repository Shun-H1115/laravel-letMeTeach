<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
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
    public function create($post)
    {
        $user = Auth::user();
        $post_c = Post::where('id', $post)->first();

        return view('reviews.create', compact('user', 'post_c'));
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
            'rating_score' => ['required'],
            'comment' => ['required', 'string'],
        ]);

        $review = new Review;
        $review->post_id = $request->post_id;
        $review->user_id = $request->user_id;
        $review->title = $request->title;
        $review->rating_score = $request->rating_score;
        $review->comment = $request->comment;
        $review->save();

        return redirect()
        ->route('posts.show', $reivew->post_id)
        ->with(['message' => 'アウトプットを投稿しました。',
        'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review, $post)
    {
        $review_edit = Review::findOrFail($review);
        $post_edit = Post::where('id', $post)->first();

        return view('reviews.edit', compact('review_edit', 'post_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review, $post)
    {
        Review::findOrFail($review)->delete();

        return redirect()
        ->route('posts.show', $post)
        ->with(['message' => 'アウトプットを削除しました。',
        'status' => 'alert']);
    }
}
