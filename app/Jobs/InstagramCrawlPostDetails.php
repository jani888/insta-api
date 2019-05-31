<?php

namespace App\Jobs;

use App\InstagramApi\ContentApi\Converters\InstagramPostConverter;
use App\InstagramApi\ContentApi\InstagramCrawler;
use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InstagramCrawlPostDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shortcode;

    /**
     * Create a new job instance.
     *
     * @param $shortcode
     */
    public function __construct($shortcode)
    {
        $this->shortcode = $shortcode;
    }

    /**
     * Execute the job.
     *
     * @param InstagramPostConverter $postConverter
     *
     * @param InstagramCrawler       $crawler
     *
     * @return void
     */
    public function handle(InstagramPostConverter $postConverter, InstagramCrawler $crawler)
    {
        $postConverter->convert($crawler->post($this->shortcode));
    }
}
