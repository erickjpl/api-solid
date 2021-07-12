<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\TipoCli;

class TipoCliApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/tipo_clis', $tipoCli
        );

        $this->assertApiResponse($tipoCli);
    }

    /**
     * @test
     */
    public function test_read_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_clis/'.$tipoCli->id
        );

        $this->assertApiResponse($tipoCli->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();
        $editedTipoCli = TipoCli::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/tipo_clis/'.$tipoCli->id,
            $editedTipoCli
        );

        $this->assertApiResponse($editedTipoCli);
    }

    /**
     * @test
     */
    public function test_delete_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/tipo_clis/'.$tipoCli->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_clis/'.$tipoCli->id
        );

        $this->response->assertStatus(404);
    }
}
