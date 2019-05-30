<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-29
 * Time: 23:41
 */

namespace App\InstagramApi;


class InstagramPostPage {

    private $sharedData;

    /**
     * InstagramExplorePage constructor.
     *
     * @param $sharedData
     */
    public function __construct($sharedData) {
        $this->sharedData = $sharedData;
        dd($sharedData);
    }

}