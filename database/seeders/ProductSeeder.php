<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product_image;
use App\Models\Product_price;
use App\Models\Product_stock;
use App\Models\Product_thumbnail;
use App\Models\Products;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::firstOrCreate(
            ['brand_name' => 'Sample Brand'],
            [
                'brand_image' => 'sample-brand.png',
                'status' => 'Active',
            ]
        );

        $category = Category::firstOrCreate(
            ['category_name' => 'Sample Category'],
            [
                'categories_id' => 'CAT-SAMPLE-001',
                'parent_category' => null,
                'category_icon' => 'ri-star-line',
                'category_image' => 'sample-category.jpg',
                'status' => 'Active',
            ]
        );

        $size = Size::firstOrCreate(
            ['size_name' => 'Default Size'],
            [
                'size' => 'M',
                'status' => 'Active',
            ]
        );

        $sampleProducts = [
            [
                'product_name' => 'Sample Cotton T-Shirt',
                'sku' => 'SAMPLE-TSHIRT-001',
                'raw_price' => '450',
                'regular_price' => '650',
                'offer_price' => '590',
                'in_stock' => '30',
                'description' => 'Comfortable cotton t-shirt for daily wear.',
            ],
            [
                'product_name' => 'Sample Slim Fit Jeans',
                'sku' => 'SAMPLE-JEANS-002',
                'raw_price' => '900',
                'regular_price' => '1250',
                'offer_price' => '1150',
                'in_stock' => '24',
                'description' => 'Stretch denim jeans with slim fit styling.',
            ],
            [
                'product_name' => 'Sample Casual Sneaker',
                'sku' => 'SAMPLE-SHOE-003',
                'raw_price' => '1200',
                'regular_price' => '1650',
                'offer_price' => '1490',
                'in_stock' => '18',
                'description' => 'Lightweight sneaker for all-day comfort.',
            ],
            [
                'product_name' => 'Sample Hoodie Jacket',
                'sku' => 'SAMPLE-HOODIE-004',
                'raw_price' => '1050',
                'regular_price' => '1450',
                'offer_price' => '1320',
                'in_stock' => '20',
                'description' => 'Warm fleece hoodie jacket for cool weather.',
            ],
            [
                'product_name' => 'Sample Sports Backpack',
                'sku' => 'SAMPLE-BAG-005',
                'raw_price' => '700',
                'regular_price' => '980',
                'offer_price' => '920',
                'in_stock' => '25',
                'description' => 'Durable backpack with multiple compartments.',
            ],
        ];

        foreach ($sampleProducts as $item) {
            $product = Products::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'product_name' => $item['product_name'],
                    'brand_id' => $brand->id,
                    'category_id' => $category->id,
                    'raw_price' => $item['raw_price'],
                    'regular_price' => $item['regular_price'],
                    'description' => $item['description'],
                    'stock' => $item['in_stock'],
                    'slug' => Str::slug($item['product_name']),
                    'status' => 'Active',
                ]
            );

            Product_price::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'offer_price' => $item['offer_price'],
                    'percentage' => null,
                    'amount' => null,
                ]
            );

            Product_stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                ],
                [
                    'inStock' => $item['in_stock'],
                    'outStock' => '0',
                    'price' => $item['regular_price'],
                    'purchase_date' => now()->toDateString(),
                ]
            );

            $baseSlug = Str::slug($item['product_name']);
            $imageNames = [
                $baseSlug . '-1.jpg',
                $baseSlug . '-2.jpg',
            ];

            foreach ($imageNames as $imageName) {
                Product_image::firstOrCreate([
                    'product_id' => $product->id,
                    'product_image' => $imageName,
                ]);

                Product_thumbnail::firstOrCreate([
                    'product_id' => $product->id,
                    'product_thumbnail' => $imageName,
                ]);
            }
        }
    }
}
