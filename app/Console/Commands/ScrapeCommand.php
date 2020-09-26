<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductType;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeCommand extends Command
{
    private $typeId = 0;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl data from lazada.vn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://www.thegioididong.com';
        $ProductType = new ProductType();
        $types = $ProductType::all();
        foreach ($types as $type) {
            $client = new Client();
            $this->typeId = $type->id;
            $crawler = $client->request('GET', $url . $type->slug);


            $crawler->filter('ul.homeproduct li.item')->each(function (Crawler $node) {
                
                $name = $node->filter('h3')->text();
                $price = $node->filter('strong')->text();
                $wholeStar = $node->filter('.icontgdd-ystar')->count();
                $halfStar = $node->filter('.icontgdd-hstar')->count();
                $rating = $wholeStar + 0.5 * $halfStar;
                $link = $node->filter('a.vertion2020')->attr('href');
                $image = $node->filter('img')->attr('src') != '' ? $node->filter('img')->attr('src') : $node->filter('img')->attr('data-original');

                $product = new Product();
                $product->name = $name;
                $product->price = preg_replace('/\D/', '', $price);
                $product->rating = $rating;
                $product->image = $image;
                $product->link = $link;
                $product->type_id = $this->typeId;
                @$product->save();
            });
        }
    }
}
