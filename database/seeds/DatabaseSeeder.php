<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $user = User::create([
            'name'     => 'jani',
            'email'    => 'jani.hidvegi@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $account = factory(\App\Models\InstagramAccount::class)->create([
            'username'  => 'thebestcarsinthe.world',
            'password'  => 'almafa1234',
            'full_name' => 'The best cars in the world',
        ]);
        $user->accounts()->attach($account);
        $hashtags = collect([
            'car',
            'cars',
            'lamborghini',
        ]);
        $hashtags->transform(function ($hashtag) {
            return \App\Models\Hashtag::create(['name' => $hashtag]);
        });
        $account->hashtags()->sync($hashtags->pluck('id'));

        $followers = factory(\App\Models\InstagramFollower::class)->times(30)->create(['instagram_account_id' => $account->id]);
        $day = 29;
        $followers->each(function (\App\Models\InstagramFollower $follower) use (&$day){
            $follower->created_at = Carbon::today()->subDays($day);
            $follower->save();
            $day--;
        });
        $account->followers()->saveMany($followers);
        //factory(\App\Models\Post::class)->times(50)->create();
    }
}
