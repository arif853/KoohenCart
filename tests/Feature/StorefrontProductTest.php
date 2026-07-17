<?php

namespace Tests\Feature;

use App\Livewire\HomeComponent;
use App\Livewire\ProductComponent;
use App\Livewire\ShopComponent;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Camp_product;
use App\Models\Category;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class StorefrontProductTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(array $overrides = []): Products
    {
        $brand = Brand::firstOrCreate(['brand_name' => 'SF Brand'], ['brand_image' => 'x.png', 'status' => 'Active']);
        $category = Category::firstOrCreate(
            ['category_name' => 'SF Category'],
            ['categories_id' => 'CAT-SF-1', 'category_icon' => 'ri-star-line', 'status' => 'Active']
        );
        $sku = 'SF-SKU-' . uniqid();

        return Products::create(array_merge([
            'product_name' => 'Storefront Product ' . $sku,
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'regular_price' => 500,
            'description' => 'desc',
            'sku' => $sku,
            'status' => 'active',
        ], $overrides));
    }

    /**
     * Campaign has no $fillable, so Campaign::create() always throws a
     * MassAssignmentException; App\Http\Controllers\Admin\CampaignController
     * itself only ever builds one via `new Campaign` + property assignment, so
     * tests do the same here rather than changing production model guarding.
     */
    private function makeCampaign(array $attributes): Campaign
    {
        $campaign = new Campaign();
        foreach ($attributes as $key => $value) {
            $campaign->{$key} = $value;
        }
        $campaign->save();

        return $campaign;
    }

    protected function setUp(): void
    {
        parent::setUp();
        Cart::instance('cart')->destroy();
        Cart::instance('wishlist')->destroy();
    }

    public function test_a_product_with_no_price_row_can_still_be_added_to_cart(): void
    {
        // Regression: every add-to-cart/wishlist path used to do
        // $product->product_price->offer_price with no null check, so a product
        // that never got a Product_price row 500'd the moment anyone tried to buy
        // it (and, separately, the moment it was merely displayed - see the
        // effectivePrice() blade tests below).
        $product = $this->makeProduct();
        $this->assertNull($product->product_price);

        Livewire::test(HomeComponent::class)->call('store', $product->id);

        $this->assertSame(1, Cart::instance('cart')->count());
        $this->assertEquals(500, Cart::instance('cart')->content()->first()->price);
    }

    public function test_add_to_wishlist_also_survives_a_missing_price_row(): void
    {
        $product = $this->makeProduct();

        Livewire::test(HomeComponent::class)->call('AddToWishlist', $product->id);

        $this->assertSame(1, Cart::instance('wishlist')->count());
    }

    public function test_a_deleted_product_id_does_not_crash_add_to_cart(): void
    {
        Livewire::test(HomeComponent::class)->call('store', 999999);
        Livewire::test(ShopComponent::class)->call('store', 999999);

        $this->assertSame(0, Cart::instance('cart')->count());
    }

    public function test_effective_price_prefers_the_offer_price_when_set(): void
    {
        $product = $this->makeProduct(['regular_price' => 1000]);
        $product->product_price()->create(['offer_price' => 800]);

        $this->assertEquals(800, $product->fresh()->effectivePrice());
    }

    public function test_effective_price_falls_back_to_regular_price_without_an_offer(): void
    {
        $product = $this->makeProduct(['regular_price' => 1000]);

        $this->assertEquals(1000, $product->effectivePrice());
    }

    public function test_effective_price_prefers_an_active_campaign_over_the_offer_price(): void
    {
        $product = $this->makeProduct(['regular_price' => 1000]);
        $product->product_price()->create(['offer_price' => 800]);

        $campaign = $this->makeCampaign([
            'camp_name' => 'Flash Sale',
            'image' => 'x.jpg',
            'status' => 'Published',
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);
        Camp_product::create([
            'product_id' => $product->id,
            'campaign_id' => $campaign->id,
            'regular_price' => 1000, 'camp_price' => 300,
        ]);

        $this->assertEquals(300, $product->fresh()->effectivePrice());
    }

    public function test_a_draft_campaign_does_not_affect_price(): void
    {
        $product = $this->makeProduct(['regular_price' => 1000]);

        $campaign = $this->makeCampaign([
            'camp_name' => 'Unpublished Sale',
            'image' => 'x.jpg',
            'status' => 'Draft',
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);
        Camp_product::create([
            'product_id' => $product->id,
            'campaign_id' => $campaign->id,
            'regular_price' => 1000, 'camp_price' => 1,
        ]);

        $this->assertEquals(1000, $product->fresh()->effectivePrice());
    }

    public function test_shop_page_no_longer_crashes_building_the_category_filter(): void
    {
        // Regression: Category::where('parent_category')->get() threw
        // ArgumentCountError - where() with one string arg needs a value/closure.
        $this->makeProduct();

        Livewire::test(ShopComponent::class)->assertOk();
    }

    public function test_shop_cart_quantity_never_drops_below_one(): void
    {
        $product = $this->makeProduct();
        Cart::instance('cart')->add($product->id, $product->product_name, 1, 500, ['image' => null, 'slug' => $product->slug]);
        $rowId = Cart::instance('cart')->content()->first()->rowId;

        Livewire::test(ShopComponent::class)->call('decreaseQuantity', $rowId);

        $this->assertSame(1, Cart::instance('cart')->get($rowId)->qty);
    }

    public function test_product_details_page_404s_for_an_unknown_slug_instead_of_crashing(): void
    {
        $this->get(route('product.detail', ['slug' => 'does-not-exist']))
            ->assertNotFound();
    }

    public function test_product_details_page_renders_for_a_product_with_no_price_row(): void
    {
        $product = $this->makeProduct();

        $this->get(route('product.detail', ['slug' => $product->slug]))
            ->assertOk()
            ->assertSee($product->product_name);
    }

    public function test_home_page_renders_a_mix_of_products_with_and_without_offers(): void
    {
        $this->makeProduct(['product_name' => 'Plain Product']);
        $withOffer = $this->makeProduct(['product_name' => 'Discounted Product', 'regular_price' => 1000]);
        $withOffer->product_price()->create(['offer_price' => 700]);

        Livewire::test(HomeComponent::class)
            ->assertOk()
            ->assertSee('700');
    }

    public function test_product_page_buy_now_respects_the_effective_price(): void
    {
        $product = $this->makeProduct(['regular_price' => 1000]);
        $product->product_price()->create(['offer_price' => 750]);

        Livewire::test(ProductComponent::class, ['slug' => $product->slug])
            ->call('buyNow', $product->id)
            ->assertRedirect(route('checkout'));

        $this->assertEquals(750, Cart::instance('cart')->content()->first()->price);
    }
}
