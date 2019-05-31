<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 13:28
 */

namespace App\InstagramApi\ContentApi\Converters;


use App\Models\InstagramAccount;

class InstagramAccountConverter {

    public function convert($data) {
        return InstagramAccount::updateOrCreate([
            'id' => $data->id,
        ], [
            'username'  => $data->username,
            'full_name' => $data->full_name ?? "",
        ]);
    }
}