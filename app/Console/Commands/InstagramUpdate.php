<?php

namespace App\Console\Commands;

use App\Jobs\InstagramCrawlHashtag;
use Illuminate\Console\Command;

class InstagramUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all hashtags';

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
    public function handle()
    {
        $hashtags = collect(['car', 'cars', 'sportscar', 'supercar', 'instacar', 'instacars', 'lamborghini', 'ferrari', 'tesla']);
        $hashtags->each(function ($hashtag){
            dispatch(new InstagramCrawlHashtag($hashtag));
        });
    }
}
