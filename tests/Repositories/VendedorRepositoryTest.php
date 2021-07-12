<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Vendedor;
use App\Repositories\Sincronizador\VendedorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VendedorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var VendedorRepository
     */
    protected $vendedorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->vendedorRepo = \App::make(VendedorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_vendedor()
    {
        $vendedor = Vendedor::factory()->make()->toArray();

        $createdVendedor = $this->vendedorRepo->create($vendedor);

        $createdVendedor = $createdVendedor->toArray();
        $this->assertArrayHasKey('id', $createdVendedor);
        $this->assertNotNull($createdVendedor['id'], 'Created Vendedor must have id specified');
        $this->assertNotNull(Vendedor::find($createdVendedor['id']), 'Vendedor with given id must be in DB');
        $this->assertModelData($vendedor, $createdVendedor);
    }

    /**
     * @test read
     */
    public function test_read_vendedor()
    {
        $vendedor = Vendedor::factory()->create();

        $dbVendedor = $this->vendedorRepo->find($vendedor->id);

        $dbVendedor = $dbVendedor->toArray();
        $this->assertModelData($vendedor->toArray(), $dbVendedor);
    }

    /**
     * @test update
     */
    public function test_update_vendedor()
    {
        $vendedor = Vendedor::factory()->create();
        $fakeVendedor = Vendedor::factory()->make()->toArray();

        $updatedVendedor = $this->vendedorRepo->update($fakeVendedor, $vendedor->id);

        $this->assertModelData($fakeVendedor, $updatedVendedor->toArray());
        $dbVendedor = $this->vendedorRepo->find($vendedor->id);
        $this->assertModelData($fakeVendedor, $dbVendedor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_vendedor()
    {
        $vendedor = Vendedor::factory()->create();

        $resp = $this->vendedorRepo->delete($vendedor->id);

        $this->assertTrue($resp);
        $this->assertNull(Vendedor::find($vendedor->id), 'Vendedor should not exist in DB');
    }
}
