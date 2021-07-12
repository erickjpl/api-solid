<?php namespace Tests\Repositories;

use App\Models\Configuracion\Connection;
use App\Repositories\Configuracion\ConnectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ConnectionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConnectionRepository
     */
    protected $connectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->connectionRepo = \App::make(ConnectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_connection()
    {
        $connection = Connection::factory()->make()->toArray();

        $createdConnection = $this->connectionRepo->create($connection);

        $createdConnection = $createdConnection->toArray();
        $this->assertArrayHasKey('id', $createdConnection);
        $this->assertNotNull($createdConnection['id'], 'Created Connection must have id specified');
        $this->assertNotNull(Connection::find($createdConnection['id']), 'Connection with given id must be in DB');
        $this->assertModelData($connection, $createdConnection);
    }

    /**
     * @test read
     */
    public function test_read_connection()
    {
        $connection = Connection::factory()->create();

        $dbConnection = $this->connectionRepo->find($connection->id);

        $dbConnection = $dbConnection->toArray();
        $this->assertModelData($connection->toArray(), $dbConnection);
    }

    /**
     * @test update
     */
    public function test_update_connection()
    {
        $connection = Connection::factory()->create();
        $fakeConnection = Connection::factory()->make()->toArray();

        $updatedConnection = $this->connectionRepo->update($fakeConnection, $connection->id);

        $this->assertModelData($fakeConnection, $updatedConnection->toArray());
        $dbConnection = $this->connectionRepo->find($connection->id);
        $this->assertModelData($fakeConnection, $dbConnection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_connection()
    {
        $connection = Connection::factory()->create();

        $resp = $this->connectionRepo->delete($connection->id);

        $this->assertTrue($resp);
        $this->assertNull(Connection::find($connection->id), 'Connection should not exist in DB');
    }
}
