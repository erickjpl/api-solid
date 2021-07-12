<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\TipoAju;

class TipoAjuApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/tipo_ajus', $tipoAju
        );

        $this->assertApiResponse($tipoAju);
    }

    /**
     * @test
     */
    public function test_read_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_ajus/'.$tipoAju->id
        );

        $this->assertApiResponse($tipoAju->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();
        $editedTipoAju = TipoAju::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/tipo_ajus/'.$tipoAju->id,
            $editedTipoAju
        );

        $this->assertApiResponse($editedTipoAju);
    }

    /**
     * @test
     */
    public function test_delete_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/tipo_ajus/'.$tipoAju->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_ajus/'.$tipoAju->id
        );

        $this->response->assertStatus(404);
    }
}
