<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Models\InstagramPost;
use App\Models\Post;
use App\Models\RejectedPost;
use App\User;

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
        //todo: Add recommendation algorithm to the query

        $hashtags = session('account')->hashtags->pluck('id');

        $scheduled = Post::where('instagram_account_id', session('account.id'))->get()->pluck('instagram_post_id');
        $rejected = RejectedPost::where('instagram_account_id', session('account.id'))->get()->pluck('instagram_post_id');

        $post = InstagramPost::with(['account', 'hashtags' => function($query) use ($hashtags){
            $query->whereIn('hashtags.id', $hashtags);
        }, 'hashtags'])
        ->whereNotIn('id', $scheduled)
        ->whereNotIn('id', $rejected)
        ->orderBy('created_at', 'DESC')->first();

        $foundBy = $hashtags->filter(function ($hashtag) use ($post){
            return in_array($hashtag, $post->hashtags->map(function ($hashtag){
                return $hashtag->id;
            })->toArray());
        });
        $description = $post->description;
        $foundBy->transform(function ($hastag_id) use ($post){
            $post->description = preg_replace('/(#' . Hashtag::find($hastag_id)->name . ' )/i', "<b class='text-primary'>$1</b>", $post->description); ;
        });
        return view('review.index', compact('post', 'description', 'foundBy'));
    }

    public function reject(InstagramPost $post) {
        RejectedPost::create([
            'instagram_post_id'    => $post->id,
            'instagram_account_id' => auth()->user()->accounts->first()->id,
        ]);
        return back();
    }
}
