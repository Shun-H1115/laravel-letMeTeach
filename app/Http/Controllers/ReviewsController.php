<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $post_create = Post::where('id', $post)->first();

        return view('posts.reviews.create', compact('user', 'post_create'));
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
        ->route('posts.show', $review->post_id)
        ->with(['message' => 'レビューを投稿しました。',
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
    public function edit($review, $post)
    {
        $user = Auth::user();
        $review_edit = Review::findOrFail($review);
        $post_edit = Post::where('id', $post)->first();

        return view('posts.reviews.edit', compact('user', 'review_edit', 'post_edit'));
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
        $review_edit = Review::findOrFail($review);

        $review_edit->title = $request->title;
        $review_edit->rating_score = $request->rating_score;
        $review_edit->comment = $request->comment;
        $review_edit->save();

        return redirect()
        ->route('posts.index')
        ->with(['message' => 'レビューを更新しました。',
        'status' => 'info']);
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
        ->with(['message' => 'レビューを削除しました。',
        'status' => 'alert']);
    }
}
