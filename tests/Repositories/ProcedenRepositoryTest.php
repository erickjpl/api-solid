<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Proceden;
use App\Repositories\Sincronizador\ProcedenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProcedenRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProcedenRepository
     */
    protected $procedenRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->procedenRepo = \App::make(ProcedenRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_proceden()
    {
        $proceden = Proceden::factory()->make()->toArray();

        $createdProceden = $this->procedenRepo->create($proceden);

        $createdProceden = $createdProceden->toArray();
        $this->assertArrayHasKey('id', $createdProceden);
        $this->assertNotNull($createdProceden['id'], 'Created Proceden must have id specified');
        $this->assertNotNull(Proceden::find($createdProceden['id']), 'Proceden with given id must be in DB');
        $this->assertModelData($proceden, $createdProceden);
    }

    /**
     * @test read
     */
    public function test_read_proceden()
    {
        $proceden = Proceden::factory()->create();

        $dbProceden = $this->procedenRepo->find($proceden->id);

        $dbProceden = $dbProceden->toArray();
        $this->assertModelData($proceden->toArray(), $dbProceden);
    }

    /**
     * @test update
     */
    public function test_update_proceden()
    {
        $proceden = Proceden::factory()->create();
        $fakeProceden = Proceden::factory()->make()->toArray();

        $updatedProceden = $this->procedenRepo->update($fakeProceden, $proceden->id);

        $this->assertModelData($fakeProceden, $updatedProceden->toArray());
        $dbProceden = $this->procedenRepo->find($proceden->id);
        $this->assertModelData($fakeProceden, $dbProceden->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_proceden()
    {
        $proceden = Proceden::factory()->create();

        $resp = $this->procedenRepo->delete($proceden->id);

        $this->assertTrue($resp);
        $this->assertNull(Proceden::find($proceden->id), 'Proceden should not exist in DB');
    }
}
