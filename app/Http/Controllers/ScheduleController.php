<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Scheduler\InstagramScheduler;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller {

    public function index() {
        $posts = auth()->user()->currentAccount->posts()->with(['instagramPost'])->whereHas('schedule', function ($query){
            $query->where('post_at', '>=', Carbon::now()->subMinutes(30));
        })->get();
        return view('schedule.index', compact('posts'));
    }

    public function store(Request $request, InstagramScheduler $scheduler) {
        $this->validate($request, [
            'description' => 'required|string',
            'post_id' => 'required|integer'
        ]);

        $post = Post::create([
            'instagram_post_id' => $request->post_id,
            'instagram_account_id' => auth()->user()->currentAccount->id,
            'description'       => $request->description,
        ]);

        $scheduled = $scheduler->enqueue($post);

        session()->flash('status', 'success');
        session()->flash('post_at', $scheduled->post_at->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_AUTO, false, 2));

        return back();
    }
}
