<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Unidades;
use App\Repositories\Sincronizador\UnidadesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UnidadesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UnidadesRepository
     */
    protected $unidadesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->unidadesRepo = \App::make(UnidadesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_unidades()
    {
        $unidades = Unidades::factory()->make()->toArray();

        $createdUnidades = $this->unidadesRepo->create($unidades);

        $createdUnidades = $createdUnidades->toArray();
        $this->assertArrayHasKey('id', $createdUnidades);
        $this->assertNotNull($createdUnidades['id'], 'Created Unidades must have id specified');
        $this->assertNotNull(Unidades::find($createdUnidades['id']), 'Unidades with given id must be in DB');
        $this->assertModelData($unidades, $createdUnidades);
    }

    /**
     * @test read
     */
    public function test_read_unidades()
    {
        $unidades = Unidades::factory()->create();

        $dbUnidades = $this->unidadesRepo->find($unidades->id);

        $dbUnidades = $dbUnidades->toArray();
        $this->assertModelData($unidades->toArray(), $dbUnidades);
    }

    /**
     * @test update
     */
    public function test_update_unidades()
    {
        $unidades = Unidades::factory()->create();
        $fakeUnidades = Unidades::factory()->make()->toArray();

        $updatedUnidades = $this->unidadesRepo->update($fakeUnidades, $unidades->id);

        $this->assertModelData($fakeUnidades, $updatedUnidades->toArray());
        $dbUnidades = $this->unidadesRepo->find($unidades->id);
        $this->assertModelData($fakeUnidades, $dbUnidades->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_unidades()
    {
        $unidades = Unidades::factory()->create();

        $resp = $this->unidadesRepo->delete($unidades->id);

        $this->assertTrue($resp);
        $this->assertNull(Unidades::find($unidades->id), 'Unidades should not exist in DB');
    }
}
