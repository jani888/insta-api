<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-29
 * Time: 23:24
 */

namespace App\InstagramApi\ContentApi\Pages;


class InstagramExplorePage {

    private $sharedData;

    /**
     * InstagramExplorePage constructor.
     *
     * @param $sharedData
     */
    public function __construct($sharedData) {
        $this->sharedData = $sharedData;
    }

    public function getTrending() {
        return $this->sharedData->entry_data->TagPage[0]->graphql->hashtag->edge_hashtag_to_top_posts->edges;
    }
}