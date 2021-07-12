<?php namespace Tests\Repositories;

use App\Models\Sincronizador\TipoPro;
use App\Repositories\Sincronizador\TipoProRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoProRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoProRepository
     */
    protected $tipoProRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoProRepo = \App::make(TipoProRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->make()->toArray();

        $createdTipoPro = $this->tipoProRepo->create($tipoPro);

        $createdTipoPro = $createdTipoPro->toArray();
        $this->assertArrayHasKey('id', $createdTipoPro);
        $this->assertNotNull($createdTipoPro['id'], 'Created TipoPro must have id specified');
        $this->assertNotNull(TipoPro::find($createdTipoPro['id']), 'TipoPro with given id must be in DB');
        $this->assertModelData($tipoPro, $createdTipoPro);
    }

    /**
     * @test read
     */
    public function test_read_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();

        $dbTipoPro = $this->tipoProRepo->find($tipoPro->id);

        $dbTipoPro = $dbTipoPro->toArray();
        $this->assertModelData($tipoPro->toArray(), $dbTipoPro);
    }

    /**
     * @test update
     */
    public function test_update_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();
        $fakeTipoPro = TipoPro::factory()->make()->toArray();

        $updatedTipoPro = $this->tipoProRepo->update($fakeTipoPro, $tipoPro->id);

        $this->assertModelData($fakeTipoPro, $updatedTipoPro->toArray());
        $dbTipoPro = $this->tipoProRepo->find($tipoPro->id);
        $this->assertModelData($fakeTipoPro, $dbTipoPro->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_pro()
    {
        $tipoPro = TipoPro::factory()->create();

        $resp = $this->tipoProRepo->delete($tipoPro->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoPro::find($tipoPro->id), 'TipoPro should not exist in DB');
    }
}
