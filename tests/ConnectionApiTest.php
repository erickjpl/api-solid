<?php namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Configuracion\Connection;

class ConnectionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_connection()
    {
        $connection = Connection::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/configuracion/connections', $connection
        );

        $this->assertApiResponse($connection);
    }

    /**
     * @test
     */
    public function test_read_connection()
    {
        $connection = Connection::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/configuracion/connections/'.$connection->id
        );

        $this->assertApiResponse($connection->toArray());
    }

    /**
     * @test
     */
    public function test_update_connection()
    {
        $connection = Connection::factory()->create();
        $editedConnection = Connection::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/configuracion/connections/'.$connection->id,
            $editedConnection
        );

        $this->assertApiResponse($editedConnection);
    }

    /**
     * @test
     */
    public function test_delete_connection()
    {
        $connection = Connection::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/configuracion/connections/'.$connection->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/configuracion/connections/'.$connection->id
        );

        $this->response->assertStatus(404);
    }
}
