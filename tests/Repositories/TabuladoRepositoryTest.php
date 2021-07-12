<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Tabulado;
use App\Repositories\Sincronizador\TabuladoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TabuladoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TabuladoRepository
     */
    protected $tabuladoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tabuladoRepo = \App::make(TabuladoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tabulado()
    {
        $tabulado = Tabulado::factory()->make()->toArray();

        $createdTabulado = $this->tabuladoRepo->create($tabulado);

        $createdTabulado = $createdTabulado->toArray();
        $this->assertArrayHasKey('id', $createdTabulado);
        $this->assertNotNull($createdTabulado['id'], 'Created Tabulado must have id specified');
        $this->assertNotNull(Tabulado::find($createdTabulado['id']), 'Tabulado with given id must be in DB');
        $this->assertModelData($tabulado, $createdTabulado);
    }

    /**
     * @test read
     */
    public function test_read_tabulado()
    {
        $tabulado = Tabulado::factory()->create();

        $dbTabulado = $this->tabuladoRepo->find($tabulado->id);

        $dbTabulado = $dbTabulado->toArray();
        $this->assertModelData($tabulado->toArray(), $dbTabulado);
    }

    /**
     * @test update
     */
    public function test_update_tabulado()
    {
        $tabulado = Tabulado::factory()->create();
        $fakeTabulado = Tabulado::factory()->make()->toArray();

        $updatedTabulado = $this->tabuladoRepo->update($fakeTabulado, $tabulado->id);

        $this->assertModelData($fakeTabulado, $updatedTabulado->toArray());
        $dbTabulado = $this->tabuladoRepo->find($tabulado->id);
        $this->assertModelData($fakeTabulado, $dbTabulado->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tabulado()
    {
        $tabulado = Tabulado::factory()->create();

        $resp = $this->tabuladoRepo->delete($tabulado->id);

        $this->assertTrue($resp);
        $this->assertNull(Tabulado::find($tabulado->id), 'Tabulado should not exist in DB');
    }
}
