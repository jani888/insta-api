<?php

namespace App\Console\Commands;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Models\Post;
use Illuminate\Console\Command;

class InstagramRepost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:repost {postID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reposts a post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(InstagramPublishingApi $publishingApi)
    {
        try{
        $post = Post::find($this->argument('postID'));
        $publishingApi->authenticate("janikahidvegi1234", "almafa1234")
            ->post(sprintf("post_image_data/%s.jpg", $post->id), " #audi #audis #auditt #ttlove #audia #s #audiquattro #quattro #audisport #audilove #audiclub #sline #car #official #likesforlike #likeforfollow #audiq #audination #carporn #vag #audifans #cars #audicarsonly #b #supercar #a #instacar #instacars #mk #sportscar");
        }catch (\Exception $e){

        }
    }
}
