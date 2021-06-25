<?php namespace Tests\Repositories;

use App\Models\Marketing\Campana;
use App\Repositories\Marketing\CampanaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CampanaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CampanaRepository
     */
    protected $campanaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->campanaRepo = \App::make(CampanaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_campana()
    {
        $campana = Campana::factory()->make()->toArray();

        $createdCampana = $this->campanaRepo->create($campana);

        $createdCampana = $createdCampana->toArray();
        $this->assertArrayHasKey('id', $createdCampana);
        $this->assertNotNull($createdCampana['id'], 'Created Campana must have id specified');
        $this->assertNotNull(Campana::find($createdCampana['id']), 'Campana with given id must be in DB');
        $this->assertModelData($campana, $createdCampana);
    }

    /**
     * @test read
     */
    public function test_read_campana()
    {
        $campana = Campana::factory()->create();

        $dbCampana = $this->campanaRepo->find($campana->id);

        $dbCampana = $dbCampana->toArray();
        $this->assertModelData($campana->toArray(), $dbCampana);
    }

    /**
     * @test update
     */
    public function test_update_campana()
    {
        $campana = Campana::factory()->create();
        $fakeCampana = Campana::factory()->make()->toArray();

        $updatedCampana = $this->campanaRepo->update($fakeCampana, $campana->id);

        $this->assertModelData($fakeCampana, $updatedCampana->toArray());
        $dbCampana = $this->campanaRepo->find($campana->id);
        $this->assertModelData($fakeCampana, $dbCampana->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_campana()
    {
        $campana = Campana::factory()->create();

        $resp = $this->campanaRepo->delete($campana->id);

        $this->assertTrue($resp);
        $this->assertNull(Campana::find($campana->id), 'Campana should not exist in DB');
    }
}
