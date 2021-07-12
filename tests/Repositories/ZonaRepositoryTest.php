<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Zona;
use App\Repositories\Sincronizador\ZonaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ZonaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ZonaRepository
     */
    protected $zonaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->zonaRepo = \App::make(ZonaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_zona()
    {
        $zona = Zona::factory()->make()->toArray();

        $createdZona = $this->zonaRepo->create($zona);

        $createdZona = $createdZona->toArray();
        $this->assertArrayHasKey('id', $createdZona);
        $this->assertNotNull($createdZona['id'], 'Created Zona must have id specified');
        $this->assertNotNull(Zona::find($createdZona['id']), 'Zona with given id must be in DB');
        $this->assertModelData($zona, $createdZona);
    }

    /**
     * @test read
     */
    public function test_read_zona()
    {
        $zona = Zona::factory()->create();

        $dbZona = $this->zonaRepo->find($zona->id);

        $dbZona = $dbZona->toArray();
        $this->assertModelData($zona->toArray(), $dbZona);
    }

    /**
     * @test update
     */
    public function test_update_zona()
    {
        $zona = Zona::factory()->create();
        $fakeZona = Zona::factory()->make()->toArray();

        $updatedZona = $this->zonaRepo->update($fakeZona, $zona->id);

        $this->assertModelData($fakeZona, $updatedZona->toArray());
        $dbZona = $this->zonaRepo->find($zona->id);
        $this->assertModelData($fakeZona, $dbZona->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_zona()
    {
        $zona = Zona::factory()->create();

        $resp = $this->zonaRepo->delete($zona->id);

        $this->assertTrue($resp);
        $this->assertNull(Zona::find($zona->id), 'Zona should not exist in DB');
    }
}
