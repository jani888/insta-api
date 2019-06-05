<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 20:45
 */

namespace App\InstagramApi\ContentApi\Converters;


use App\Models\InstagramPost;
use Illuminate\Support\Collection;

class InstagramHashtagParser {
    public function parse(InstagramPost $post) {
        $hashtags = Collection::make(explode("#", $post->description));

        $hashtags->shift();
        $hashtags->transform(function($hashtag){
            $endstr = strpos($hashtag, " ");
            return substr($hashtag, 0, $endstr ? $endstr : strlen($hashtag));
        });
    }
}