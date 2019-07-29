<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-28
 * Time: 14:56
 */

namespace App\InstagramApi\ContentApi;


use App\InstagramApi\ContentApi\Pages\InstagramAccountPage;
use App\InstagramApi\ContentApi\Pages\InstagramExplorePage;
use App\InstagramApi\ContentApi\Pages\InstagramPostPage;
use App\Models\InstagramAccount;
use GuzzleHttp\Client;

class InstagramCrawler {

    private const BASE_URL = "https://www.instagram.com/";

    /**
     * @var Client
     */
    private $client;

    /**
     * InstagramContentApi constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function post($shortcode): InstagramPostPage {
        $html = $this->client->get(self::BASE_URL . 'p/' . $shortcode)->getBody()->getContents();
        $page = $this->parsePost($html);
        return $page;
    }

    private function parsePost(string $html): InstagramPostPage {
        return new InstagramPostPage($this->getSharedData($html));
    }

    private function getSharedData(string $html) {
        $start = strpos($html, "window._sharedData = ");
        $end = strpos($html, "};", $start);
        $start += strlen("window._sharedData = ");
        return json_decode(substr($html, $start, $end - $start + 1));
    }

    public function explore($hashtag): InstagramExplorePage {
        $html = $this->client->get(self::BASE_URL . 'explore/tags/' . $hashtag)->getBody()->getContents();
        $page = $this->parseExplore($html);
        return $page;
    }

    private function parseExplore(string $html): InstagramExplorePage {
        return new InstagramExplorePage($this->getSharedData($html));
    }

    public function account(InstagramAccount $account) {
        $html = $this->client->get(self::BASE_URL . $account->username)->getBody()->getContents();
        $page = $this->parseAccount($html);
        return $page;
    }

    private function parseAccount(string $html): InstagramAccountPage{
        return new InstagramAccountPage($this->getSharedData($html));
    }
}