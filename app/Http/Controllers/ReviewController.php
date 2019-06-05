<?php

namespace App\Http\Controllers;

use App\Models\InstagramAccount;
use App\Models\InstagramPost;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //todo: Query only the posts to the current account
        //todo: Add recommendation algorithm to the query
        //todo: Dont show already scheduled posts
        $description = "asdfasfasdfasdf";
        $post = InstagramPost::with('account')->orderBy('created_at', 'DESC')->first();
        return view('review.index', compact('post', 'description'));
    }
}
