<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\Proceden;

class ProcedenApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_proceden()
    {
        $proceden = Proceden::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/procedens', $proceden
        );

        $this->assertApiResponse($proceden);
    }

    /**
     * @test
     */
    public function test_read_proceden()
    {
        $proceden = Proceden::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/procedens/'.$proceden->id
        );

        $this->assertApiResponse($proceden->toArray());
    }

    /**
     * @test
     */
    public function test_update_proceden()
    {
        $proceden = Proceden::factory()->create();
        $editedProceden = Proceden::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/procedens/'.$proceden->id,
            $editedProceden
        );

        $this->assertApiResponse($editedProceden);
    }

    /**
     * @test
     */
    public function test_delete_proceden()
    {
        $proceden = Proceden::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/procedens/'.$proceden->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/procedens/'.$proceden->id
        );

        $this->response->assertStatus(404);
    }
}
