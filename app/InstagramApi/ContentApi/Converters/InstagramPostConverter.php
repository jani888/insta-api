<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 12:23
 */

namespace App\InstagramApi\ContentApi\Converters;


use App\InstagramApi\ContentApi\Pages\InstagramPostPage;
use App\Models\InstagramPost;
use Illuminate\Support\Facades\Storage;

class InstagramPostConverter {

    /** @var InstagramAccountConverter */
    protected $instagramAccountConverter;

    /**
     * @var InstagramHashtagParser
     */
    private $hashtagParser;

    /**
     * InstagramPostConverter constructor.
     *
     * @param InstagramAccountConverter $instagramAccountConverter
     * @param InstagramHashtagParser    $descriptionConverter
     */
    public function __construct(InstagramAccountConverter $instagramAccountConverter, InstagramHashtagParser $descriptionConverter) {
        $this->instagramAccountConverter = $instagramAccountConverter;
        $this->hashtagParser = $descriptionConverter;
    }


    public function convert(InstagramPostPage $page) {
        if(InstagramPost::where('shortcode', $page->getShortcode())->count() > 0) return;
        //Létrehozza a Post-ot, commenteket, menti az usert
        $post = InstagramPost::create([
            'likes'                => $page->getLikes(),
            'description'          => $page->getDescription(),
            'shortcode'            => $page->getShortcode(),
            'img_src'              => $page->getImageSource(),
            'instagram_account_id' => $this->instagramAccountConverter->convert($page->getOwner())->id,
        ]);
        $this->getImage($post, $post->img_src);
		$hashtags = $this->hashtagParser->parse($post);
		$post->hashtags()->sync($hashtags);
        return $post;
    }

    private function getImage(InstagramPost $post, $img_src) {
        $image = file_get_contents($img_src);
        Storage::put(sprintf("post_image_data/%s.jpg", $post->id), $image);
    }
}
