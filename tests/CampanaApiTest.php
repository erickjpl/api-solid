<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Marketing\Campana;

class CampanaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_campana()
    {
        $campana = Campana::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/marketing/campanas', $campana
        );

        $this->assertApiResponse($campana);
    }

    /**
     * @test
     */
    public function test_read_campana()
    {
        $campana = Campana::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/marketing/campanas/'.$campana->id
        );

        $this->assertApiResponse($campana->toArray());
    }

    /**
     * @test
     */
    public function test_update_campana()
    {
        $campana = Campana::factory()->create();
        $editedCampana = Campana::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/marketing/campanas/'.$campana->id,
            $editedCampana
        );

        $this->assertApiResponse($editedCampana);
    }

    /**
     * @test
     */
    public function test_delete_campana()
    {
        $campana = Campana::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/marketing/campanas/'.$campana->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/marketing/campanas/'.$campana->id
        );

        $this->response->assertStatus(404);
    }
}
