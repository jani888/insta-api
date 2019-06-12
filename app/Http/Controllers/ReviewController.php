<?php

namespace App\Http\Controllers;

use App\Models\InstagramPost;
use App\Models\Post;
use App\Models\RejectedPost;

class ReviewController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        //todo: Query only the posts to the current account
        //todo: Add recommendation algorithm to the query
        //todo: Dont show already scheduled posts
        $description = "asdfasfasdfasdf";
        $scheduled = Post::where('instagram_account_id', auth()->user()->accounts->first()->id)->get()->pluck('instagram_post_id');
        $rejected = RejectedPost::where('instagram_account_id', auth()->user()->accounts->first()->id)->get()->pluck('instagram_post_id');
        $post = InstagramPost::with('account')->whereNotIn('id', $scheduled)->whereNotIn('id', $rejected)->orderBy('created_at', 'DESC')->first();
        return view('review.index', compact('post', 'description'));
    }

    public function reject(InstagramPost $post) {
        RejectedPost::create([
            'instagram_post_id' => $post->id,
            'instagram_account_id' => auth()->user()->accounts->first()->id
        ]);
        return back();
    }
}
