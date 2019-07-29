<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-07-23
 * Time: 16:58
 */

namespace App\InstagramApi\ContentApi\Pages;


class InstagramAccountPage{

    private $sharedData;
    private $user;

    public function __construct($sharedData) {
        $this->sharedData = $sharedData;
        $this->user = $this->sharedData->entry_data->ProfilePage[0]->graphql->user;
    }

    public function followers() {
        return $this->user->edge_followed_by->count;
    }
}