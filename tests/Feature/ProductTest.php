<?php

namespace Tests\Feature;

use App\Contracts\Services\SendEmailService;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\Services\FakeSmsService;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }


    public function test_get_products(): void
    {
        /** @var Collection $products */
        $products = Product::factory(5)->create();

        $response = $this->getJson(route('v1.products.index'));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'errors',
                'data' => [
                    '*' =>
                        [
                            'id',
                            'name',
                            'price'
                        ]
                ]
            ])
            ->assertJsonPath('data.*.id', $products->modelKeys());
    }


    public function test_get_product(): void
    {
        /** @var Product $product */
        $product = Product::factory()->create();

        $response = $this->getJson(route('v1.products.show',  $product->id));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'errors',
                'data' => [
                    'id',
                    'name',
                    'price'
                ]
            ])
            ->assertJson([
                'data' => [
                    'id'    => $product->id,
                    'name'  => $product->name,
                    'price' => $product->price
                ]
            ]);
    }

    public function test_create_product()
    {
        // Mock
        $this->mock(SendEmailService::class, function (MockInterface $mock) {
            $mock->shouldReceive('sendEmail')
                ->andReturnNull()
                ->once();
        });

        // Concrete Substitution
//        $this->app->bind(SendEmailService::class, FakeSmsService::class);

        $inputData = [
            'name'  => $this->faker->text,
            'price' => $this->faker->numberBetween()
        ];

        $response = $this->postJson(route('v1.products.store'), $inputData);

        $response->assertSuccessful()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'errors',
                'data' => [
                    'id',
                    'name',
                    'price'
                ]
            ]);

        $this->assertDatabaseHas('products', $inputData);
    }

    public function test_update_product()
    {
        /** @var Product $product */
        $product = Product::factory()->create();

        $updateData = [
            'name'  => $this->faker->text,
            'price' => $this->faker->numberBetween()
        ];

        $response = $this->putJson(route('v1.products.update', $product->id), $updateData);

        $response->assertSuccessful()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'errors',
                'data'
            ])
            ->assertJson([
                'message' => 'Product updated!'
            ]);

        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            ...$updateData
        ]);
    }

    public function test_delete_product()
    {
        /** @var Product $product */
        $product = Product::factory()->create();

        $response = $this->delete(route('v1.products.delete', $product->id));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'errors',
                'data'
            ])
            ->assertJson([
                'message' => 'Product deleted!'
            ]);


        $this->assertDatabaseMissing('products', [
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price
        ]);

    }
}
