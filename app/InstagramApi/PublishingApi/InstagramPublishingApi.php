<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 17:11
 */

namespace App\InstagramApi\PublishingApi;


use App\InstagramApi\PublishingApi\Vendor\InstagramUploadApi;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\LocalFileDetector;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Faker\Generator;
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
        if(!$this->authenticated) throw new \RuntimeException('Not authenticated!');
        $this->uploadApi->publishPost($file, $description);
    }

}