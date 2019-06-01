<?php

namespace App\Console\Commands;

use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class InstagramRepost extends Command {

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
    public function handle(InstagramPublishingApi $publishingApi) {
        $tags = Arr::random([
            "#cars #car #bmw #carsofinstagram #carporn #auto #supercars #luxury #mercedes #carlifestyle #porsche #ferrari #audi #photography #supercar #instacar #jdm #racing #carswithoutlimits #s #lamborghini #turbo #ford #m #r #like #nissan #f #speed #bhfyp",
            "#mk #luxurycars #instacars #automotive #v #amg #toyota #e #gt #sportscar #follow #rs #drive #honda #instagood #bhfyp #stance #bmwm #cargram #race #instagram #exoticcars #carstagram #vw #carphotography #amazingcars #wheels #volkswagen #x #drift",
        ]);
        try {
            $post = Post::find($this->argument('postID'));
            dump("[" . Carbon::now()->format('Y-m-d H:i:s') . "] " . "Reposting {$post->id}...");
            $publishingApi->authenticate("thebestcarsinthe.world", "almafa1234")->post(sprintf("post_image_data/%s.jpg", $post->id), $tags);
            dump("[" . Carbon::now()->format('Y-m-d H:i:s') . "] " . "Success!");
        } catch (\Exception $e) {
            dump("[" . Carbon::now()->format('Y-m-d H:i:s') . "] " . "Failed to repost!");
        }
    }
}
