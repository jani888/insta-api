<?php

namespace App\Jobs;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Models\Post;
use App\Models\PostSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InstagramPublishPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var PostSchedule
     */
    private $scheduled;

    /**
     * Create a new job instance.
     *
     * @param PostSchedule $scheduled
     */
    public function __construct(PostSchedule $scheduled)
    {
        $this->scheduled = $scheduled;
    }

    /**
     * Execute the job.
     *
     * @param InstagramPublishingApi $publishingApi
     *
     * @return void
     */
    public function handle(InstagramPublishingApi $publishingApi)
    {
        $username = $this->scheduled->post->account->username;
        $password = $this->scheduled->post->account->password;

        $publishingApi->authenticate($username, $password)->post(sprintf("post_image_data/%s.jpg", $this->scheduled->post->id), $this->scheduled->description);

        $this->scheduled->posted = true;
        $this->scheduled->save();
    }
}
