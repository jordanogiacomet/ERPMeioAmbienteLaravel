<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\DefaultRepository;
use Mockery;

class DefaultRepositoryTest extends TestCase
{
    protected $modelMock;
    protected $repository;

    protected function setUp(): void 
    {
        parent::setUp();

        $this->modelMock = Mockery::mock(Model::class);
        $this->repository = new DefaultRepository($this->modelMock);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testAllMethodReturnsCollection()
    {
        $this->modelMock->shouldReceive('all')->once()->andReturn(new Collection());
        $result = $this->repository->all();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testFindMethodReturnsModel()
    {
        $modelInstance = Mockery::mock(Model::class);
        $this->modelMock->shouldReceive('findOrFail')->with(1)->andReturn($modelInstance);

        $result = $this->repository->find(1);

        $this->assertInstanceOf(Model::class, $result);
    }
    public function testCreateMethodReturnsModel()
    {
        $formRequestMock = Mockery::mock(FormRequest::class);
        $formRequestMock->shouldReceive('validated')->once()->andReturn(['key' => 'value']);

        $modelInstance = Mockery::mock(Model::class);
        $this->modelMock->shouldReceive('create')->with(['key' => 'value'])->once()->andReturn($modelInstance);

        $result = $this->repository->create($formRequestMock);

        $this->assertInstanceOf(Model::class, $result);
    }

    public function testUpdateMethodReturnsModel()
    {
        $modelInstance = Mockery::mock(Model::class);
        $this->modelMock->shouldReceive('findOrFail')->with(1)->once()->andReturn($modelInstance);

        $formRequestMock = Mockery::mock(FormRequest::class);
        $formRequestMock->shouldReceive('validated')->once()->andReturn(['key' => 'value']);

        $modelInstance->shouldReceive('update')->with(['key' => 'value'])->once();

        $result = $this->repository->update(1, $formRequestMock);

        $this->assertInstanceOf(Model::class, $result);
    }

    public function testDeleteMethod()
    {
        $modelInstance = Mockery::mock(Model::class);
        $this->modelMock->shouldReceive('findOrFail')->with(1)->once()->andReturn($modelInstance);
        $modelInstance->shouldReceive('delete')->once();

        $this->repository->delete(1);

        $this->assertTrue(true); 
    }
}