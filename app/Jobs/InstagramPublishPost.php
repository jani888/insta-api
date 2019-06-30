<?php

namespace App\Jobs;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Models\PostSchedule;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class InstagramPublishPost implements ShouldQueue {

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
    public function __construct(PostSchedule $scheduled) {
        $this->scheduled = $scheduled;
    }

    /**
     * Execute the job.
     *
     * @param InstagramPublishingApi $publishingApi
     *
     * @return void
     */
    public function handle(InstagramPublishingApi $publishingApi) {
        $username = $this->scheduled->post->account->username;
        $password = $this->scheduled->post->account->password;

        try {
            $publishingApi->authenticate($username, $password)->post(sprintf("post_image_data/%s.jpg", $this->scheduled->post->id), $this->scheduled->description);
            $this->scheduled->posted_at = Carbon::now();
        } catch (\Exception $e) {
            Log::warning("[PUBLISHING SCHEDULE] Instagram API error.", [
                'error' => $e->getMessage(),
                'user'  => $username,
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTrace(),
            ]);
            $this->scheduled->attempts++;
        }

        $this->scheduled->save();
    }
}
