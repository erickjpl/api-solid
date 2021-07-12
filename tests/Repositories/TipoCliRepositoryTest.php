<?php namespace Tests\Repositories;

use App\Models\Sincronizador\TipoCli;
use App\Repositories\Sincronizador\TipoCliRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoCliRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoCliRepository
     */
    protected $tipoCliRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoCliRepo = \App::make(TipoCliRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->make()->toArray();

        $createdTipoCli = $this->tipoCliRepo->create($tipoCli);

        $createdTipoCli = $createdTipoCli->toArray();
        $this->assertArrayHasKey('id', $createdTipoCli);
        $this->assertNotNull($createdTipoCli['id'], 'Created TipoCli must have id specified');
        $this->assertNotNull(TipoCli::find($createdTipoCli['id']), 'TipoCli with given id must be in DB');
        $this->assertModelData($tipoCli, $createdTipoCli);
    }

    /**
     * @test read
     */
    public function test_read_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();

        $dbTipoCli = $this->tipoCliRepo->find($tipoCli->id);

        $dbTipoCli = $dbTipoCli->toArray();
        $this->assertModelData($tipoCli->toArray(), $dbTipoCli);
    }

    /**
     * @test update
     */
    public function test_update_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();
        $fakeTipoCli = TipoCli::factory()->make()->toArray();

        $updatedTipoCli = $this->tipoCliRepo->update($fakeTipoCli, $tipoCli->id);

        $this->assertModelData($fakeTipoCli, $updatedTipoCli->toArray());
        $dbTipoCli = $this->tipoCliRepo->find($tipoCli->id);
        $this->assertModelData($fakeTipoCli, $dbTipoCli->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_cli()
    {
        $tipoCli = TipoCli::factory()->create();

        $resp = $this->tipoCliRepo->delete($tipoCli->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoCli::find($tipoCli->id), 'TipoCli should not exist in DB');
    }
}
