<?php

namespace App\Console\Commands;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Jobs\InstagramPublishPost;
use App\Models\Hashtag;
use App\Models\PostSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateHashtagCounts extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashtags:calculate_counts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the counts for all hashtags';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param InstagramPublishingApi $publishingApi
     *
     */
    public function handle() {
        Hashtag::with('posts')->each(function ($hashtag){
            $hashtag->update(['count' => $hashtag->posts->count()]);
        });
    }
}
