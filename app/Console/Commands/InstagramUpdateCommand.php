<?php

namespace App\Console\Commands;

use App\Jobs\InstagramCrawlHashtag;
use App\Models\Hashtag;
use Illuminate\Console\Command;

class InstagramUpdateCommand extends Command
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
        $hashtags = Hashtag::latest()->pluck('name');
        $hashtags->each(function ($hashtag){
            $this->info("Updating {$hashtag}...");
            try{
                dispatch(new InstagramCrawlHashtag($hashtag));
            } catch (\Exception $e){
                $this->warn($e->getMessage());
            }
        });
    }
}
