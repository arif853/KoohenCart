<?php

namespace App\Console\Commands;

use App\Models\Products;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    
    {
        $sitemap = Sitemap::create();
         // Static pages
        $sitemap->add('/');
        $sitemap->add('/privacy_and_policy');
        $sitemap->add('/terms-and-condition');
        $sitemap->add('/cancellation_and_return');
        $sitemap->add('/delivery_information');
        $sitemap->add('/aboutus');
        $sitemap->add('/contactus');
        // Dynamic pages
        $products = Products::all();
        foreach ($products as $product) {
            $sitemap->add(Url::create("/products/{$product->slug}")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
            // $sitemap->add(Url::create('/product/'.$product->slug));
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
