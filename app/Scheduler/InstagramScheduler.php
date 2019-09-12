<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-06-05
 * Time: 21:57
 */

namespace App\Scheduler;


use App\Models\Post;
use App\Models\PostSchedule;
use Carbon\Carbon;

class InstagramScheduler {

    public function enqueue(Post $post) {
        return PostSchedule::create([
            'post_at' => $this->nextTimeframe($post->instagram_account_id),
            'post_id' => $post->id,
        ]);
    }

    private function nextTimeframe($instagram_account_id) {
        $latestPostDate = Carbon::parse( PostSchedule::whereHas('post', function ($q) use ($instagram_account_id){
            return $q->where('instagram_account_id', $instagram_account_id);
        })->max('post_at'));

        if($latestPostDate->isPast()){
            $latestPostDate = Carbon::now();
        }

        return $latestPostDate->addMinutes(20);
    }
}