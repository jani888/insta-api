<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 2019-05-28
 * Time: 14:56
 */

namespace App\InstagramApi\ContentApi;


use App\InstagramApi\ContentApi\Converters\InstagramPostConverter;
use App\InstagramApi\ContentApi\Pages\InstagramPostPage;
use App\Jobs\InstagramCrawlPostDetails;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class InstagramContentApi {

    private const BASE_URL = "https://www.instagram.com/explore/tags/";

    /** @var InstagramCrawler */
    protected $crawler;

    /** @var InstagramPostConverter */
    protected $instagramPostConverter;

    /**
     * InstagramContentApi constructor.
     *
     * @param InstagramCrawler       $crawler
     * @param InstagramPostConverter $instagramPostConverter
     */
    public function __construct(InstagramCrawler $crawler, InstagramPostConverter $instagramPostConverter) {
        $this->crawler = $crawler;
        $this->instagramPostConverter = $instagramPostConverter;
    }

    public function getTrendingPostsByHashtag($hashtag) {
        $trending = $this->crawler->explore($hashtag)->getTrending();
        $shortcodes = Collection::make(Arr::pluck($trending, "node.shortcode"));
        $shortcodes->each(function ($shortcode) {
            dispatch(new InstagramCrawlPostDetails($shortcode));
        });
    }
}