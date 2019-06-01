<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\InstagramApi\ContentApi\Converters\InstagramHashtagParser;
use App\InstagramApi\ContentApi\InstagramContentApi;
use App\InstagramApi\PublishingApi\InstagramPublishingApi;
use App\Models\Post;
use Illuminate\Http\Request;

class ContentController extends Controller {
    public function get(Request $request, $hashtag, InstagramContentApi $contentApi) {
        $this->validate($request, ['limit' => 'optional|integer|min:1|max:10']);

        $contentApi->getTrendingPostsByHashtag($hashtag);
    }

    public function post(InstagramPublishingApi $publishingApi) {
        $publishingApi->authenticate("janikahidvegi1234", "almafa1234")->post(storage_path("alma.jpg"), "test");
    }

    public function hashtag(InstagramHashtagParser $hashtagParser){
        $post = Post::make([
            'likes' => 3,
            'shortcode' => '',
            'instagram_acount_id' => 23,
            'description' => 'még valami valami #first #r8 #v10 #cars --- Valami --- #paris #london benne is még valami #travel #voituredesport #voituredeluxe #luxe #luxury #miami #istanbul #porsche #911 #carrera #car #hypercars   ---- al',
        ]);
        $hashtagParser->parse($post);
    }
}
