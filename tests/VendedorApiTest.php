<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Vendedor;

class VendedorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_vendedor()
    {
        $vendedor = Vendedor::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/vendedors', $vendedor
        );

        $this->assertApiResponse($vendedor);
    }

    /**
     * @test
     */
    public function test_read_vendedor()
    {
        $vendedor = Vendedor::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/vendedors/'.$vendedor->id
        );

        $this->assertApiResponse($vendedor->toArray());
    }

    /**
     * @test
     */
    public function test_update_vendedor()
    {
        $vendedor = Vendedor::factory()->create();
        $editedVendedor = Vendedor::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/vendedors/'.$vendedor->id,
            $editedVendedor
        );

        $this->assertApiResponse($editedVendedor);
    }

    /**
     * @test
     */
    public function test_delete_vendedor()
    {
        $vendedor = Vendedor::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/vendedors/'.$vendedor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/vendedors/'.$vendedor->id
        );

        $this->response->assertStatus(404);
    }
}
