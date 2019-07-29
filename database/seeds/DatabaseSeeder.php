<?php

use App\User;
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
        //factory(\App\Models\Post::class)->times(50)->create();
    }
}
