<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Segmento;

class SegmentoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_segmento()
    {
        $segmento = Segmento::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/segmentos', $segmento
        );

        $this->assertApiResponse($segmento);
    }

    /**
     * @test
     */
    public function test_read_segmento()
    {
        $segmento = Segmento::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/segmentos/'.$segmento->id
        );

        $this->assertApiResponse($segmento->toArray());
    }

    /**
     * @test
     */
    public function test_update_segmento()
    {
        $segmento = Segmento::factory()->create();
        $editedSegmento = Segmento::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/segmentos/'.$segmento->id,
            $editedSegmento
        );

        $this->assertApiResponse($editedSegmento);
    }

    /**
     * @test
     */
    public function test_delete_segmento()
    {
        $segmento = Segmento::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/segmentos/'.$segmento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/segmentos/'.$segmento->id
        );

        $this->response->assertStatus(404);
    }
}
