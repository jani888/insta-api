<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-31
 * Time: 17:11
 */

namespace App\InstagramApi\PublishingApi;


use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\LocalFileDetector;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;

class InstagramPublishingApi {

    /** @var bool */
    private $authenticated = false;

    /**
     * @var Browser
     */
    private $browser;

    /**
     * InstagramPublishingApi constructor.
     *
     * @param Browser $browser
     */
    public function __construct() {
        $ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1';
        $capabilities = DesiredCapabilities::chrome();
        $options = new ChromeOptions;
        $options->setExperimentalOption('mobileEmulation', ['userAgent' => $ua]);
        $this->browser = new Browser(RemoteWebDriver::create(
            'http://localhost:9515', $options->toCapabilities()
        ));
    }

    public function authenticate($username, $password) {
        $this->login($username, $password);
        return $this;
    }

    public function post() {
        if(!$this->authenticated) throw new \RuntimeException('Not authenticated!');
        //$this->browser->waitForText("Bekapcsolás")->driver->findElement(WebDriverBy::xpath("//button[text()='Bekapcsolás']"))->click();
        $this->browser->pause(3000)->driver->findElement(WebDriverBy::className('tb_sK'))->setFileDetector(new LocalFileDetector())->sendKeys(storage_path('kep.png'))->submit();
    }

    private function login($username, $password) {
        $this->browser->visit("https://www.instagram.com/accounts/login")
            ->waitFor('[name=username]')
            ->waitFor('[name=password]')
            ->type('[name=username]', $username)
            ->type('[name=password]', $password)
            ->click('button[type=submit]');

        $this->authenticated = true;
    }
}