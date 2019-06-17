<?php

namespace App\Console\Commands;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Jobs\InstagramPublishPost;
use App\Models\PostSchedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InstagramPostCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post all scheduled a posts';

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
     * @return mixed
     */
    public function handle() {
        $posts = PostSchedule::with(['post', 'post.account'])->where('post_at', '<', Carbon::now())->get();
        $posts->each(function ($post){
            InstagramPublishPost::dispatch($post);
        });
    }
}
