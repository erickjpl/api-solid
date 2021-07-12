<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Tabulado;

class TabuladoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tabulado()
    {
        $tabulado = Tabulado::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/tabulados', $tabulado
        );

        $this->assertApiResponse($tabulado);
    }

    /**
     * @test
     */
    public function test_read_tabulado()
    {
        $tabulado = Tabulado::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tabulados/'.$tabulado->id
        );

        $this->assertApiResponse($tabulado->toArray());
    }

    /**
     * @test
     */
    public function test_update_tabulado()
    {
        $tabulado = Tabulado::factory()->create();
        $editedTabulado = Tabulado::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/tabulados/'.$tabulado->id,
            $editedTabulado
        );

        $this->assertApiResponse($editedTabulado);
    }

    /**
     * @test
     */
    public function test_delete_tabulado()
    {
        $tabulado = Tabulado::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/tabulados/'.$tabulado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/tabulados/'.$tabulado->id
        );

        $this->response->assertStatus(404);
    }
}
