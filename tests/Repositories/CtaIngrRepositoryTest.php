<?php namespace Tests\Repositories;

use App\Models\Sincronizador\CtaIngr;
use App\Repositories\Sincronizador\CtaIngrRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CtaIngrRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CtaIngrRepository
     */
    protected $ctaIngrRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->ctaIngrRepo = \App::make(CtaIngrRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->make()->toArray();

        $createdCtaIngr = $this->ctaIngrRepo->create($ctaIngr);

        $createdCtaIngr = $createdCtaIngr->toArray();
        $this->assertArrayHasKey('id', $createdCtaIngr);
        $this->assertNotNull($createdCtaIngr['id'], 'Created CtaIngr must have id specified');
        $this->assertNotNull(CtaIngr::find($createdCtaIngr['id']), 'CtaIngr with given id must be in DB');
        $this->assertModelData($ctaIngr, $createdCtaIngr);
    }

    /**
     * @test read
     */
    public function test_read_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();

        $dbCtaIngr = $this->ctaIngrRepo->find($ctaIngr->id);

        $dbCtaIngr = $dbCtaIngr->toArray();
        $this->assertModelData($ctaIngr->toArray(), $dbCtaIngr);
    }

    /**
     * @test update
     */
    public function test_update_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();
        $fakeCtaIngr = CtaIngr::factory()->make()->toArray();

        $updatedCtaIngr = $this->ctaIngrRepo->update($fakeCtaIngr, $ctaIngr->id);

        $this->assertModelData($fakeCtaIngr, $updatedCtaIngr->toArray());
        $dbCtaIngr = $this->ctaIngrRepo->find($ctaIngr->id);
        $this->assertModelData($fakeCtaIngr, $dbCtaIngr->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cta_ingr()
    {
        $ctaIngr = CtaIngr::factory()->create();

        $resp = $this->ctaIngrRepo->delete($ctaIngr->id);

        $this->assertTrue($resp);
        $this->assertNull(CtaIngr::find($ctaIngr->id), 'CtaIngr should not exist in DB');
    }
}
