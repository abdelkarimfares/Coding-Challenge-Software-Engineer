<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A Product Creation test
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $data = [
                'name' => "New Product test",
                'description' => "This is a product",
                'price' => 199,
                'categories' => [],
                'image' => "test-image.png"
                ];
        
        $response = $this->json('POST', '/api/products/create', $data);
        $response->assertStatus(200);
    }
}
