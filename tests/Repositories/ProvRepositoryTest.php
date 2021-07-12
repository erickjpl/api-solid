<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Prov;
use App\Repositories\Sincronizador\ProvRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProvRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProvRepository
     */
    protected $provRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->provRepo = \App::make(ProvRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_prov()
    {
        $prov = Prov::factory()->make()->toArray();

        $createdProv = $this->provRepo->create($prov);

        $createdProv = $createdProv->toArray();
        $this->assertArrayHasKey('id', $createdProv);
        $this->assertNotNull($createdProv['id'], 'Created Prov must have id specified');
        $this->assertNotNull(Prov::find($createdProv['id']), 'Prov with given id must be in DB');
        $this->assertModelData($prov, $createdProv);
    }

    /**
     * @test read
     */
    public function test_read_prov()
    {
        $prov = Prov::factory()->create();

        $dbProv = $this->provRepo->find($prov->id);

        $dbProv = $dbProv->toArray();
        $this->assertModelData($prov->toArray(), $dbProv);
    }

    /**
     * @test update
     */
    public function test_update_prov()
    {
        $prov = Prov::factory()->create();
        $fakeProv = Prov::factory()->make()->toArray();

        $updatedProv = $this->provRepo->update($fakeProv, $prov->id);

        $this->assertModelData($fakeProv, $updatedProv->toArray());
        $dbProv = $this->provRepo->find($prov->id);
        $this->assertModelData($fakeProv, $dbProv->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_prov()
    {
        $prov = Prov::factory()->create();

        $resp = $this->provRepo->delete($prov->id);

        $this->assertTrue($resp);
        $this->assertNull(Prov::find($prov->id), 'Prov should not exist in DB');
    }
}
