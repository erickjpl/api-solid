<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\TipoPro;

class TipoProApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/tipo_pros', $tipoPro
        );

        $this->assertApiResponse($tipoPro);
    }

    /**
     * @test
     */
    public function test_read_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_pros/'.$tipoPro->id
        );

        $this->assertApiResponse($tipoPro->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();
        $editedTipoPro = TipoPro::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/tipo_pros/'.$tipoPro->id,
            $editedTipoPro
        );

        $this->assertApiResponse($editedTipoPro);
    }

    /**
     * @test
     */
    public function test_delete_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/tipo_pros/'.$tipoPro->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tipo_pros/'.$tipoPro->id
        );

        $this->response->assertStatus(404);
    }
}
