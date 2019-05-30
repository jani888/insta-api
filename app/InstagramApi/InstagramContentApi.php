<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-28
 * Time: 14:56
 */

namespace App\InstagramApi;


use function foo\func;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class InstagramContentApi {

    private const BASE_URL = "https://www.instagram.com/explore/tags/";

    /** @var InstagramCrawler */
    protected $crawler;

    /**
     * InstagramContentApi constructor.
     *
     * @param InstagramCrawler $crawler
     */
    public function __construct(InstagramCrawler $crawler) {
        $this->crawler = $crawler;
    }

    public function getTrendingPostsByHashtag($hashtag) {
        $trending = $this->crawler->explore($hashtag)->getTrending();
        $shorcodes = Collection::make(Arr::pluck($trending, "node.shortcode"));
        $crawled = $shorcodes->map(function($shortcode){
            return $this->crawlDetails($shortcode);
        });
    }

    private function crawlDetails($shortcode) {
        return $this->crawler->post($shortcode);
    }
}