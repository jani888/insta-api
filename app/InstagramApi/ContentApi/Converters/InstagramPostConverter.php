<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 12:23
 */

namespace App\InstagramApi\ContentApi\Converters;


use App\InstagramApi\ContentApi\Pages\InstagramPostPage;
use App\Models\Post;

class InstagramPostConverter {

    /** @var InstagramAccountConverter */
    protected $instagramAccountConverter;

    /**
     * InstagramPostConverter constructor.
     *
     * @param InstagramAccountConverter $instagramAccountConverter
     */
    public function __construct(InstagramAccountConverter $instagramAccountConverter) {
        $this->instagramAccountConverter = $instagramAccountConverter;
    }


    public function convert(InstagramPostPage $page) {
        //Létrehozza a Post-ot, commenteket, menti az usert
        Post::create([
            'likes'                => $page->getLikes(),
            'description'          => $page->getDescription(),
            'shortcode'            => $page->getShortcode(),
            'instagram_account_id' => $this->instagramAccountConverter->convert($page->getOwner())->id,
        ]);
    }
}