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
     * @var InstagramDescriptionConverter
     */
    private $descriptionConverter;

    /**
     * InstagramPostConverter constructor.
     *
     * @param InstagramAccountConverter     $instagramAccountConverter
     * @param InstagramDescriptionConverter $descriptionConverter
     */
    public function __construct(InstagramAccountConverter $instagramAccountConverter, InstagramDescriptionConverter $descriptionConverter) {
        $this->instagramAccountConverter = $instagramAccountConverter;
        $this->descriptionConverter = $descriptionConverter;
    }


    public function convert(InstagramPostPage $page) {
        //Létrehozza a Post-ot, commenteket, menti az usert
        $post = Post::create([
            'likes'                => $page->getLikes(),
            'description'          => $page->getDescription(),
            'shortcode'            => $page->getShortcode(),
            'instagram_account_id' => $this->instagramAccountConverter->convert($page->getOwner())->id,
        ]);
        $this->descriptionConverter->convert($post, $page->getDescription());
        return $post;
    }
}