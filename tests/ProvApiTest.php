<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Prov;

class ProvApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_prov()
    {
        $prov = Prov::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/provs', $prov
        );

        $this->assertApiResponse($prov);
    }

    /**
     * @test
     */
    public function test_read_prov()
    {
        $prov = Prov::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/provs/'.$prov->id
        );

        $this->assertApiResponse($prov->toArray());
    }

    /**
     * @test
     */
    public function test_update_prov()
    {
        $prov = Prov::factory()->create();
        $editedProv = Prov::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/provs/'.$prov->id,
            $editedProv
        );

        $this->assertApiResponse($editedProv);
    }

    /**
     * @test
     */
    public function test_delete_prov()
    {
        $prov = Prov::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/provs/'.$prov->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/provs/'.$prov->id
        );

        $this->response->assertStatus(404);
    }
}
