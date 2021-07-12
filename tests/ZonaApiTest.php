<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Zona;

class ZonaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_zona()
    {
        $zona = Zona::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/zonas', $zona
        );

        $this->assertApiResponse($zona);
    }

    /**
     * @test
     */
    public function test_read_zona()
    {
        $zona = Zona::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/zonas/'.$zona->id
        );

        $this->assertApiResponse($zona->toArray());
    }

    /**
     * @test
     */
    public function test_update_zona()
    {
        $zona = Zona::factory()->create();
        $editedZona = Zona::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/zonas/'.$zona->id,
            $editedZona
        );

        $this->assertApiResponse($editedZona);
    }

    /**
     * @test
     */
    public function test_delete_zona()
    {
        $zona = Zona::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/zonas/'.$zona->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/zonas/'.$zona->id
        );

        $this->response->assertStatus(404);
    }
}
