<?php

namespace App\Console\Commands;

use App\Jobs\InstagramCrawlAccountStats;
use App\Jobs\InstagramCrawlHashtag;
use App\Models\Hashtag;
use App\Models\InstagramAccount;
use Illuminate\Console\Command;

class InstagramUpdateStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update account statistics';

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
        InstagramAccount::each(function ($account){
            $this->info("Updating {$account->username}...");
            try{
                dispatch_now(new InstagramCrawlAccountStats($account));
            } catch (\Exception $e){
                $this->warn($e->getMessage());
            }
        });
    }
}
