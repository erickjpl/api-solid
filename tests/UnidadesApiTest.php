<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Unidades;

class UnidadesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_unidades()
    {
        $unidades = Unidades::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/unidades', $unidades
        );

        $this->assertApiResponse($unidades);
    }

    /**
     * @test
     */
    public function test_read_unidades()
    {
        $unidades = Unidades::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/unidades/'.$unidades->id
        );

        $this->assertApiResponse($unidades->toArray());
    }

    /**
     * @test
     */
    public function test_update_unidades()
    {
        $unidades = Unidades::factory()->create();
        $editedUnidades = Unidades::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/unidades/'.$unidades->id,
            $editedUnidades
        );

        $this->assertApiResponse($editedUnidades);
    }

    /**
     * @test
     */
    public function test_delete_unidades()
    {
        $unidades = Unidades::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/unidades/'.$unidades->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/unidades/'.$unidades->id
        );

        $this->response->assertStatus(404);
    }
}
