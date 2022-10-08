<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Testing\Fluent\AssertableJson;

class ProductsControllerTest extends TestCase
{

    /**
     * Home test.
     *
     */
    public function test_get_home()
    {
        $response = $this->getJson('/api');
        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {
            $json->whereType('msg', 'string');
        });
    }

    /**
     * List all product test.
     *
     */
    public function test_get_all_products()
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(13);
    }

    /**
     * List one single product test.
     *
     */
    public function test_get_single_product()
    {
        $product = Product::limit(1)->get()->toArray()[0]['code'];
        $response = $this->getJson('/api/products/' . $product);

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) {
            $json->hasAll([
                'data.code',
                'data.barcode',
                'data.status',
                'data.imported_t',
                'data.url',
                'data.product_name',
                'data.quantity',
                'data.categories',
                'data.packaging',
                'data.brands',
                'data.image_url'
            ]);
        });
    }
}
