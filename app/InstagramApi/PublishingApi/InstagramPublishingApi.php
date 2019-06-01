<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 17:11
 */

namespace App\InstagramApi\PublishingApi;


use App\InstagramApi\PublishingApi\Vendor\InstagramUploadApi;
use App\InstagramApi\PublishingApi\Vendor\InstagramUploadApi2;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravel\Dusk\Browser;

class InstagramPublishingApi {

    /** @var bool */
    private $authenticated = false;

    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var InstagramPublishingApi
     */
    private $uploadApi;

    /**
     * InstagramPublishingApi constructor.
     *
     * @param InstagramUploadApi $uploadApi
     */
    public function __construct(InstagramUploadApi $uploadApi) {
        $this->uploadApi = $uploadApi;
    }

    public function authenticate($username, $password) {
        $this->uploadApi->authenticate($username, $password);
        $this->authenticated = true;
        return $this;
    }

    public function post($file, $description) {
        //$this->makeImageSquare($file);

        if (!$this->authenticated) throw new \RuntimeException('Not authenticated!');
        $this->uploadApi->publishPost(storage_path('app/' . $file), $description);
    }

    private function makeImageSquare($file) {
        $img = Image::make(storage_path( 'app/' . $file));

        $width = $img->width();
        $height = $img->height();


        /*
        *  canvas
        */
        $dimension = 2362;

        $vertical = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square = (($width = $height) ? true : false);

        if ($vertical) {
            $top = $bottom = 245;
            $newHeight = ($dimension) - ($bottom + $top);
            $img->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($horizontal) {
            $right = $left = 245;
            $newWidth = ($dimension) - ($right + $left);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($square) {
            $right = $left = 245;
            $newWidth = ($dimension) - ($left + $right);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }

        $img->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        return Storage::put($file, (string) $img->encode());
    }

}