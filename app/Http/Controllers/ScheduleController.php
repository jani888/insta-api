<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Scheduler\InstagramScheduler;
use Illuminate\Http\Request;

class ScheduleController extends Controller {

    public function enqueue(Request $request, InstagramScheduler $scheduler) {
        $this->validate($request, [
            'description' => 'required|string',
            'post_id' => 'required|integer'
        ]);

        $post = Post::create([
            'instagram_post_id' => $request->post_id,
            'instagram_account_id' => auth()->user()->accounts->first()->id,
            'description'       => $request->description,
        ]);

        $scheduler->enqueue($post);

        session()->flash('status', 'success');

        return back();
    }
}
