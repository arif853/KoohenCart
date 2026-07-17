<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Products;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductDependenciesTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::where('email', 'admin@koohen.com')->firstOrFail();
    }

    // --- Brand ---------------------------------------------------------

    public function test_creating_a_category_without_an_icon_no_longer_crashes(): void
    {
        // Regression: category_icon was NOT NULL with no default, but the form
        // never marked it required and store() only assigned it inside
        // hasFile('category_icon') - submitting without one threw a QueryException.
        Storage::fake('public');

        $this->actingAs($this->admin())->post(route('category.store'), [
            'categories_id' => 'CAT-NOICON-1',
            'category_name' => 'No Icon Category',
            'status' => '1',
        ])->assertRedirect();

        $this->assertDatabaseHas('categories', ['category_name' => 'No Icon Category']);
    }

    public function test_deleting_a_brand_with_products_is_blocked_not_cascaded(): void
    {
        // Regression: products.brand_id cascades at the DB level, so the old
        // try/catch around delete() never caught anything - deleting a brand with
        // products silently wiped those products instead of being blocked.
        Storage::fake('public');
        $brand = Brand::create(['brand_name' => 'InUse Brand', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-BRAND-1', 'category_name' => 'Cat', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $product = Products::create([
            'product_name' => 'Brand Guarded Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'description' => 'd', 'sku' => 'BRANDGUARD-1', 'status' => 'active',
        ]);

        $this->actingAs($this->admin())
            ->delete(route('brands.destroy', $brand->id))
            ->assertRedirect();

        $this->assertDatabaseHas('brands', ['id' => $brand->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_deleting_an_unused_brand_succeeds(): void
    {
        Storage::fake('public');
        $brand = Brand::create(['brand_name' => 'Unused Brand', 'brand_image' => 'x.png', 'status' => 1]);

        $this->actingAs($this->admin())
            ->delete(route('brands.destroy', $brand->id))
            ->assertRedirect();

        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }

    public function test_updating_a_brand_with_a_bad_id_404s_instead_of_fataling(): void
    {
        $this->actingAs($this->admin())->post(route('brands.update'), [
            'brand_id' => 999999,
            'brand_name' => 'x',
        ])->assertNotFound();
    }

    public function test_creating_a_brand_with_a_duplicate_name_does_not_leave_an_orphaned_image(): void
    {
        Storage::fake('public');
        Brand::create(['brand_name' => 'Duplicate Brand', 'brand_image' => 'existing.png', 'status' => 1]);

        $this->actingAs($this->admin())->post(route('brands.store'), [
            'brand_name' => 'Duplicate Brand',
            'brand_image' => UploadedFile::fake()->image('dup.jpg'),
        ])->assertSessionHasErrors('brand_name');

        $this->assertSame(1, Brand::where('brand_name', 'Duplicate Brand')->count());
        Storage::disk('public')->assertDirectoryEmpty('brand_image');
    }

    // --- Category --------------------------------------------------------

    public function test_deleting_a_category_with_products_is_blocked_not_cascaded(): void
    {
        Storage::fake('public');
        $brand = Brand::create(['brand_name' => 'B', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-GUARD-1', 'category_name' => 'Guarded Category', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $product = Products::create([
            'product_name' => 'Category Guarded Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'description' => 'd', 'sku' => 'CATGUARD-1', 'status' => 'active',
        ]);

        $this->actingAs($this->admin())
            ->delete(route('category.destroy', $category->id))
            ->assertRedirect();

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_deleting_a_category_with_a_subcategory_is_blocked(): void
    {
        Storage::fake('public');
        $category = Category::create([
            'categories_id' => 'CAT-SUBGUARD-1', 'category_name' => 'Has Subcategory', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        // Subcategory::$fillable lists 'category', not 'category_id' - mass
        // assignment of category_id is silently dropped, so it's set directly.
        $subcategory = new Subcategory([
            'subcategory_name' => 'Child', 'subcategory_image' => 'x.png', 'status' => 1,
        ]);
        $subcategory->category_id = $category->id;
        $subcategory->save();

        $this->actingAs($this->admin())
            ->delete(route('category.destroy', $category->id))
            ->assertRedirect();

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_updating_a_category_with_a_bad_id_404s(): void
    {
        $this->actingAs($this->admin())->post(route('category.update'), [
            'category_id' => 999999,
            'category_name' => 'x',
        ])->assertNotFound();
    }

    public function test_category_names_must_be_unique(): void
    {
        Category::create([
            'categories_id' => 'CAT-DUP-1', 'category_name' => 'Dup Category', 'category_icon' => 'i.png', 'status' => 1,
        ]);

        $this->actingAs($this->admin())->post(route('category.store'), [
            'categories_id' => 'CAT-DUP-2',
            'category_name' => 'Dup Category',
        ])->assertSessionHasErrors('category_name');

        $this->assertSame(1, Category::where('category_name', 'Dup Category')->count());
    }

    // --- Subcategory -------------------------------------------------------

    public function test_subcategory_index_page_renders(): void
    {
        // Regression: the controller pointed at admin.category.subcategory.index,
        // a view that does not exist anywhere in the project - this page 500'd
        // unconditionally.
        $this->actingAs($this->admin())
            ->get(route('subcategory.index'))
            ->assertOk();
    }

    public function test_creating_a_subcategory_works_end_to_end(): void
    {
        Storage::fake('public');
        $category = Category::create([
            'categories_id' => 'CAT-SUB-1', 'category_name' => 'Parent', 'category_icon' => 'i.png', 'status' => 1,
        ]);

        $this->actingAs($this->admin())->post(route('subcategory.store'), [
            'category' => $category->id,
            'subcategory_name' => 'New Subcategory',
            'subcategory_image' => UploadedFile::fake()->image('sub.jpg'),
        ])->assertRedirect();

        $this->assertDatabaseHas('subcategories', ['subcategory_name' => 'New Subcategory']);
    }

    public function test_updating_a_subcategory_with_a_bad_id_404s(): void
    {
        $this->actingAs($this->admin())->post(route('subcategory.update'), [
            'subcategory_id' => 999999,
            'category' => 1,
            'subcategory_name' => 'x',
        ])->assertNotFound();
    }

    public function test_deleting_a_subcategory_with_a_bad_id_404s_instead_of_a_misleading_message(): void
    {
        $this->actingAs($this->admin())
            ->delete(route('subcategory.destroy', 999999))
            ->assertNotFound();
    }

    // --- Supplier ------------------------------------------------------

    public function test_deleting_a_supplier_with_products_is_blocked_not_cascaded(): void
    {
        $brand = Brand::create(['brand_name' => 'B2', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-SUP-1', 'category_name' => 'C2', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $supplier = Supplier::create([
            'supplier_name' => 'Guarded Supplier', 'address' => 'addr', 'phone' => '123', 'status' => 'Active',
        ]);
        $product = Products::create([
            'product_name' => 'Supplier Guarded Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'supplier_id' => $supplier->id, 'description' => 'd', 'sku' => 'SUPGUARD-1', 'status' => 'active',
        ]);

        $this->actingAs($this->admin())
            ->json('DELETE', route('supplier.destroy'), ['id' => $supplier->id])
            ->assertRedirect();

        $this->assertDatabaseHas('suppliers', ['id' => $supplier->id]);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_updating_a_supplier_with_a_bad_id_404s(): void
    {
        $this->actingAs($this->admin())->post(route('supplier.update'), [
            'supplier_id' => 999999,
            'supplier_name' => 'x',
            'address' => 'a',
            'phone' => '1',
        ])->assertNotFound();
    }

    // --- Variant: Color --------------------------------------------------

    public function test_updating_a_color_with_a_bad_id_404s(): void
    {
        $this->actingAs($this->admin())->post(route('color.update'), [
            'id' => 999999,
            'color_name' => 'x',
            'color_code' => '#fff',
        ])->assertNotFound();
    }

    public function test_deleting_a_color_assigned_to_a_product_is_blocked(): void
    {
        $color = Color::create(['color_name' => 'Guarded Color', 'color_code' => '#000', 'status' => 1]);
        $brand = Brand::create(['brand_name' => 'B3', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-COL-1', 'category_name' => 'C3', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $product = Products::create([
            'product_name' => 'Color Guarded Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'description' => 'd', 'sku' => 'COLGUARD-1', 'status' => 'active',
        ]);
        $product->colors()->attach($color->id);

        $this->actingAs($this->admin())
            ->delete(route('color.destroy', $color->id))
            ->assertRedirect();

        $this->assertDatabaseHas('colors', ['id' => $color->id]);
    }

    // --- Variant: Size ---------------------------------------------------

    public function test_duplicate_size_names_are_rejected(): void
    {
        // Regression: size_store() validated uniqueness against colors.color_name
        // instead of sizes.size_name (copy-paste from color_store()), and the
        // manual fallback check read $sizes->sizes_name (typo; the real column is
        // size_name) - both bugs together meant duplicate size names always
        // passed straight through.
        Size::create(['size_name' => 'Extra Large', 'size' => 'XL', 'status' => 1]);

        $this->actingAs($this->admin())->post(route('size.store'), [
            'size_name' => 'Extra Large',
            'size_value' => 'XL2',
        ])->assertSessionHasErrors('size_name');

        $this->assertSame(1, Size::where('size_name', 'Extra Large')->count());
    }

    public function test_updating_a_size_with_a_bad_id_404s(): void
    {
        $this->actingAs($this->admin())->post(route('size.update'), [
            'size_id' => 999999,
            'size_name' => 'x',
            'size_value' => 'y',
        ])->assertNotFound();
    }

    public function test_deleting_a_size_assigned_to_a_product_is_blocked(): void
    {
        $size = Size::create(['size_name' => 'Guarded Size', 'size' => 'GS', 'status' => 1]);
        $brand = Brand::create(['brand_name' => 'B4', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-SIZE-1', 'category_name' => 'C4', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $product = Products::create([
            'product_name' => 'Size Guarded Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'description' => 'd', 'sku' => 'SIZEGUARD-1', 'status' => 'active',
        ]);
        $product->sizes()->attach($size->id);

        $this->actingAs($this->admin())
            ->delete(route('size.destroy', $size->id))
            ->assertRedirect();

        $this->assertDatabaseHas('sizes', ['id' => $size->id]);
    }

    public function test_an_unused_size_can_still_be_deleted(): void
    {
        $size = Size::create(['size_name' => 'Free Size', 'size' => 'FS', 'status' => 1]);

        $this->actingAs($this->admin())
            ->delete(route('size.destroy', $size->id))
            ->assertRedirect();

        $this->assertDatabaseMissing('sizes', ['id' => $size->id]);
    }

    // --- Products::$fillable --------------------------------------------

    public function test_editing_a_products_supplier_actually_saves(): void
    {
        // Regression: supplier_id was missing from Products::$fillable, but
        // ProductController::update() sets it via mass assignment
        // ($product->update([...])), unlike store() which assigns it directly as
        // a property. Every product edit silently dropped whatever supplier was
        // chosen, with no error - the field just never saved.
        Storage::fake('public');
        $brand = Brand::create(['brand_name' => 'B5', 'brand_image' => 'x.png', 'status' => 1]);
        $category = Category::create([
            'categories_id' => 'CAT-SUPFIX-1', 'category_name' => 'C5', 'category_icon' => 'i.png', 'status' => 1,
        ]);
        $supplier = Supplier::create([
            'supplier_name' => 'Reassign Supplier', 'address' => 'addr', 'phone' => '123', 'status' => 'Active',
        ]);
        $product = Products::create([
            'product_name' => 'Reassignable Product', 'brand_id' => $brand->id, 'category_id' => $category->id,
            'description' => 'd', 'sku' => 'SUPFIX-1', 'status' => 'active',
        ]);
        $this->assertNull($product->supplier_id);

        $this->actingAs($this->admin())->patch(route('products.update', $product->id), [
            'product_name' => 'Reassignable Product',
            'product_brand' => $brand->id,
            'product_category' => $category->id,
            'supplier' => $supplier->id,
            'description' => 'd',
            'status' => 'active',
        ])->assertRedirect(route('products.index'));

        $this->assertSame($supplier->id, $product->fresh()->supplier_id);
    }
}
