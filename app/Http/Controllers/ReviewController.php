<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
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
        //todo: Add recommendation algorithm to the query

        $hashtags = auth()->user()->currentAccount->hashtags->pluck('id');

        $scheduled = Post::where('instagram_account_id', auth()->user()->currentAccount->id)->get()->pluck('instagram_post_id');
        $rejected = RejectedPost::where('instagram_account_id', auth()->user()->currentAccount->id)->get()->pluck('instagram_post_id');

        $posts = auth()->user()->currentAccount->hashtags()->with('posts')->get()->flatMap(function ($hashtag) {
            return $hashtag->posts;
        });
        $posts = $posts->reject(function ($post) use ($scheduled, $rejected) {
            return $scheduled->contains($post->id) || $rejected->contains($post->id);
        });

        $post = $posts->random();

        $foundBy = $hashtags->filter(function ($hashtag) use ($post) {
            return in_array($hashtag, $post->hashtags->map(function ($hashtag) {
                return $hashtag->id;
            })->toArray());
        });
        $description = $post->description;
        $foundBy->transform(function ($hastag_id) use ($post) {
            $post->description = preg_replace('/(#' . Hashtag::find($hastag_id)->name . ' )/i', "<b class='text-primary'>$1</b>", $post->description);;
        });
        return view('review.index', compact('post', 'description', 'foundBy'));
    }

    public function reject(InstagramPost $post) {
        RejectedPost::create([
            'instagram_post_id'    => $post->id,
            'instagram_account_id' => auth()->user()->currentAccount->id
        ]);
        return back();
    }
}
