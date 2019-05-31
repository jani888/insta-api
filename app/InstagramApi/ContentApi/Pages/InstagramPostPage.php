<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-29
 * Time: 23:41
 */

namespace App\InstagramApi\ContentApi\Pages;


class InstagramPostPage {

    private $postData;

    private $sharedData;

    /**
     * InstagramExplorePage constructor.
     *
     * @param $sharedData
     */
    public function __construct($sharedData) {
        $this->sharedData = $sharedData;
        $this->postData = $this->sharedData->entry_data->PostPage[0]->graphql->shortcode_media;
    }

    public function getLikes() {
        return $this->postData->edge_media_preview_like->count;
    }

    public function getDescription() {
        return $this->postData->edge_media_to_caption->edges[0]->node->text;
    }

    public function getOwner() {
        return $this->postData->owner;
    }

    public function getShortcode() {
        return $this->postData->shortcode;
    }

}