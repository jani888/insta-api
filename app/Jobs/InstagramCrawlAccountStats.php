<?php

namespace App\Jobs;

use App\InstagramApi\ContentApi\InstagramCrawler;
use App\Models\InstagramFollower;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InstagramCrawlAccountStats implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $account;

    /**
     * Create a new job instance.
     *
     * @param $account
     */
    public function __construct($account) {
        //
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @param InstagramCrawler $crawler
     *
     * @return void
     */
    public function handle(InstagramCrawler $crawler) {
        $account = $crawler->account($this->account);
        $this->account->followers()->save(new InstagramFollower(['value' => $account->followers()]));
    }
}
