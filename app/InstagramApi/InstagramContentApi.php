<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-28
 * Time: 14:56
 */

namespace App\InstagramApi;


use GuzzleHttp\Client;

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
        $posts = array_map(function ($post){
            return $this->crawlDetails($post);
        }, $trending);
    }

    private function crawlDetails($post) {
        return $this->crawler->post($post->node->shortcode);
    }
}