<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product_image;
use App\Models\Product_price;
use App\Models\Product_thumbnail;
use App\Models\Products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::where('email', 'admin@koohen.com')->firstOrFail();
    }

    private function brandAndCategory(): array
    {
        return [
            Brand::firstOrCreate(['brand_name' => 'Test Brand'], ['brand_image' => 'x.png', 'status' => 'Active']),
            Category::firstOrCreate(
                ['category_name' => 'Test Category'],
                ['categories_id' => 'CAT-TEST-1', 'category_icon' => 'ri-star-line', 'status' => 'Active']
            ),
        ];
    }

    public function test_admin_can_create_a_product_with_images_and_thumbnail(): void
    {
        Storage::fake('public');
        [$brand, $category] = $this->brandAndCategory();

        $response = $this->actingAs($this->admin())->post(route('products.store'), [
            'product_name' => 'New Test Product',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'regular_price' => 1000,
            'description' => 'A product for testing.',
            'sku' => 'TEST-SKU-001',
            'status' => 'active',
            'tags' => 'red,summer',
            'product_image' => [UploadedFile::fake()->image('a.jpg')],
            'product_thumbnail' => [UploadedFile::fake()->image('a-thumb.jpg')],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $product = Products::where('sku', 'TEST-SKU-001')->firstOrFail();
        $this->assertSame('new-test-product', $product->slug);
        $this->assertCount(1, $product->product_images);
        $this->assertCount(1, $product->product_thumbnail);
        $this->assertCount(2, $product->tags);
        Storage::disk('public')->assertExists('product_images/' . $product->product_images->first()->product_image);
    }

    public function test_creating_a_product_requires_a_thumbnail(): void
    {
        // Regression: the validation rule used to check 'product_thumnail.*' (typo)
        // while the form field is 'product_thumbnail[]', so this requirement never
        // actually applied.
        Storage::fake('public');
        [$brand, $category] = $this->brandAndCategory();

        $response = $this->actingAs($this->admin())->post(route('products.store'), [
            'product_name' => 'No Thumb Product',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'regular_price' => 1000,
            'description' => 'desc',
            'sku' => 'NO-THUMB-1',
            'status' => 'active',
            'product_image' => [UploadedFile::fake()->image('a.jpg')],
            // no product_thumbnail
        ]);

        $response->assertSessionHasErrors('product_thumbnail');
        $this->assertDatabaseMissing('products', ['sku' => 'NO-THUMB-1']);
    }

    public function test_creating_a_product_with_a_blank_tags_field_does_not_crash(): void
    {
        Storage::fake('public');
        [$brand, $category] = $this->brandAndCategory();

        $response = $this->actingAs($this->admin())->post(route('products.store'), [
            'product_name' => 'Tagless Product',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'regular_price' => 500,
            'description' => 'desc',
            'sku' => 'TAGLESS-1',
            'status' => 'active',
            'product_image' => [UploadedFile::fake()->image('a.jpg')],
            'product_thumbnail' => [UploadedFile::fake()->image('a-thumb.jpg')],
            // 'tags' intentionally omitted entirely (null, not '')
        ]);

        $response->assertSessionHasNoErrors();
        $product = Products::where('sku', 'TAGLESS-1')->firstOrFail();
        $this->assertCount(0, $product->tags);
    }

    public function test_admin_can_update_a_product_and_uploaded_images_are_additive(): void
    {
        Storage::fake('public');
        [$brand, $category] = $this->brandAndCategory();

        $product = Products::create([
            'product_name' => 'Editable Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'regular_price' => 800,
            'description' => 'desc',
            'sku' => 'EDIT-SKU-1',
            'status' => 'active',
        ]);
        Product_image::create(['product_id' => $product->id, 'product_image' => 'existing.jpg']);

        $response = $this->actingAs($this->admin())->patch(route('products.update', $product->id), [
            'product_name' => 'Editable Product Updated',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'regular_price' => 900,
            'description' => 'updated desc',
            'status' => 'active',
            'tags' => 'blue',
            'product_image' => [UploadedFile::fake()->image('b.jpg')],
        ]);

        $response->assertRedirect(route('products.index'));

        $product->refresh();
        $this->assertSame('Editable Product Updated', $product->product_name);
        $this->assertEquals(900, $product->regular_price);
        // The pre-existing image must survive; the new upload is additional, not a replacement.
        $this->assertCount(2, $product->product_images);
    }

    public function test_updating_tags_removes_ones_no_longer_submitted(): void
    {
        [$brand, $category] = $this->brandAndCategory();

        $product = Products::create([
            'product_name' => 'Tag Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'regular_price' => 500,
            'description' => 'desc',
            'sku' => 'TAG-SKU-1',
            'status' => 'active',
        ]);
        $product->tags()->create(['tag' => 'old-tag']);

        $this->actingAs($this->admin())->patch(route('products.update', $product->id), [
            'product_name' => 'Tag Product',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'regular_price' => 500,
            'description' => 'desc',
            'status' => 'active',
            'tags' => 'new-tag',
        ])->assertRedirect(route('products.index'));

        $product->refresh();
        $this->assertSame(['new-tag'], $product->tags->pluck('tag')->all());
    }

    public function test_deleting_a_product_removes_its_image_files_from_disk(): void
    {
        Storage::fake('public');
        [$brand, $category] = $this->brandAndCategory();

        $product = Products::create([
            'product_name' => 'Deletable Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'regular_price' => 500,
            'description' => 'desc',
            'sku' => 'DEL-SKU-1',
            'status' => 'active',
        ]);
        Storage::disk('public')->put('product_images/keepme.jpg', 'fake-bytes');
        Storage::disk('public')->put('product_images/thumbnail/keepme-thumb.jpg', 'fake-bytes');
        Product_image::create(['product_id' => $product->id, 'product_image' => 'keepme.jpg']);
        Product_thumbnail::create(['product_id' => $product->id, 'product_thumbnail' => 'keepme-thumb.jpg']);

        $this->actingAs($this->admin())
            ->delete(route('products.destroy', $product->id))
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing('product_images/keepme.jpg');
        Storage::disk('public')->assertMissing('product_images/thumbnail/keepme-thumb.jpg');
    }

    public function test_updating_a_missing_product_returns_404_instead_of_a_null_error(): void
    {
        [$brand, $category] = $this->brandAndCategory();

        $this->actingAs($this->admin())->patch(route('products.update', 999999), [
            'product_name' => 'x',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'description' => 'desc',
            'status' => 'active',
        ])->assertNotFound();
    }
}
