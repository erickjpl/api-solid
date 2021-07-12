<?php namespace Tests\Repositories;

use App\Models\Sincronizador\TipoAju;
use App\Repositories\Sincronizador\TipoAjuRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoAjuRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoAjuRepository
     */
    protected $tipoAjuRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoAjuRepo = \App::make(TipoAjuRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->make()->toArray();

        $createdTipoAju = $this->tipoAjuRepo->create($tipoAju);

        $createdTipoAju = $createdTipoAju->toArray();
        $this->assertArrayHasKey('id', $createdTipoAju);
        $this->assertNotNull($createdTipoAju['id'], 'Created TipoAju must have id specified');
        $this->assertNotNull(TipoAju::find($createdTipoAju['id']), 'TipoAju with given id must be in DB');
        $this->assertModelData($tipoAju, $createdTipoAju);
    }

    /**
     * @test read
     */
    public function test_read_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();

        $dbTipoAju = $this->tipoAjuRepo->find($tipoAju->id);

        $dbTipoAju = $dbTipoAju->toArray();
        $this->assertModelData($tipoAju->toArray(), $dbTipoAju);
    }

    /**
     * @test update
     */
    public function test_update_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();
        $fakeTipoAju = TipoAju::factory()->make()->toArray();

        $updatedTipoAju = $this->tipoAjuRepo->update($fakeTipoAju, $tipoAju->id);

        $this->assertModelData($fakeTipoAju, $updatedTipoAju->toArray());
        $dbTipoAju = $this->tipoAjuRepo->find($tipoAju->id);
        $this->assertModelData($fakeTipoAju, $dbTipoAju->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_aju()
    {
        $tipoAju = TipoAju::factory()->create();

        $resp = $this->tipoAjuRepo->delete($tipoAju->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoAju::find($tipoAju->id), 'TipoAju should not exist in DB');
    }
}
