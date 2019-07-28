<?php

namespace App\Jobs;

use App\InstagramApi\ContentApi\InstagramContentApi;
use App\InstagramApi\ContentApi\InstagramCrawler;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InstagramCrawlHashtag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $hashtag;

    /**
     * Create a new job instance.
     *
     * @param $hashtag
     */
    public function __construct($hashtag)
    {
        //
        $this->hashtag = $hashtag;
    }

    /**
     * Execute the job.
     *
     * @param InstagramCrawler $contentApi
     *
     * @return void
     */
    public function handle(InstagramContentApi $contentApi)
    {
        $contentApi->getTrendingPostsByHashtag($this->hashtag);
    }
}
