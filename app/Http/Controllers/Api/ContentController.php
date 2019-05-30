<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\InstagramApi\InstagramContentApi;
use Illuminate\Http\Request;

class ContentController extends Controller {

    public function get(Request $request, $hashtag, InstagramContentApi $contentApi) {
        $this->validate($request, ['limit' => 'optional|integer|min:1|max:10']);
        $limit = $request->limit ?? 5;

        $posts = $contentApi->getTrendingPostsByHashtag($hashtag, $limit);
        return PostResource::collection($posts);
    }
}
