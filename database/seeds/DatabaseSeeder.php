<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'jani', 'email' => 'jani.hidvegi@gmail.com', 'password' => bcrypt('admin')]);
        $account = factory(\App\Models\InstagramAccount::class)->create();
        $user->accounts()->attach($account);
        $hashtags = factory(App\Models\Hashtag::class)->times(10)->create();
        $account->hashtags()->sync($hashtags->random(3)->pluck('id'));
        //factory(\App\Models\Post::class)->times(50)->create();
    }
}
