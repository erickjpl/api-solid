<?php namespace Tests\Repositories;

use App\Models\Sincronizador\Segmento;
use App\Repositories\Sincronizador\SegmentoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SegmentoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SegmentoRepository
     */
    protected $segmentoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->segmentoRepo = \App::make(SegmentoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_segmento()
    {
        $segmento = Segmento::factory()->make()->toArray();

        $createdSegmento = $this->segmentoRepo->create($segmento);

        $createdSegmento = $createdSegmento->toArray();
        $this->assertArrayHasKey('id', $createdSegmento);
        $this->assertNotNull($createdSegmento['id'], 'Created Segmento must have id specified');
        $this->assertNotNull(Segmento::find($createdSegmento['id']), 'Segmento with given id must be in DB');
        $this->assertModelData($segmento, $createdSegmento);
    }

    /**
     * @test read
     */
    public function test_read_segmento()
    {
        $segmento = Segmento::factory()->create();

        $dbSegmento = $this->segmentoRepo->find($segmento->id);

        $dbSegmento = $dbSegmento->toArray();
        $this->assertModelData($segmento->toArray(), $dbSegmento);
    }

    /**
     * @test update
     */
    public function test_update_segmento()
    {
        $segmento = Segmento::factory()->create();
        $fakeSegmento = Segmento::factory()->make()->toArray();

        $updatedSegmento = $this->segmentoRepo->update($fakeSegmento, $segmento->id);

        $this->assertModelData($fakeSegmento, $updatedSegmento->toArray());
        $dbSegmento = $this->segmentoRepo->find($segmento->id);
        $this->assertModelData($fakeSegmento, $dbSegmento->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_segmento()
    {
        $segmento = Segmento::factory()->create();

        $resp = $this->segmentoRepo->delete($segmento->id);

        $this->assertTrue($resp);
        $this->assertNull(Segmento::find($segmento->id), 'Segmento should not exist in DB');
    }
}
