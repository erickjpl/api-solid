<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sincronizador\CtaIngr;

class CtaIngrApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sincronizador/cta_ingrs', $ctaIngr
        );

        $this->assertApiResponse($ctaIngr);
    }

    /**
     * @test
     */
    public function test_read_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sincronizador/cta_ingrs/'.$ctaIngr->id
        );

        $this->assertApiResponse($ctaIngr->toArray());
    }

    /**
     * @test
     */
    public function test_update_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();
        $editedCtaIngr = CtaIngr::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sincronizador/cta_ingrs/'.$ctaIngr->id,
            $editedCtaIngr
        );

        $this->assertApiResponse($editedCtaIngr);
    }

    /**
     * @test
     */
    public function test_delete_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sincronizador/cta_ingrs/'.$ctaIngr->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sincronizador/cta_ingrs/'.$ctaIngr->id
        );

        $this->response->assertStatus(404);
    }
}
