<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesRequest;
use Tests\TestCase;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_when_a_series_is_created_its_seasons_and_episoes_must_also_be_created()
    {
        // Arrange
        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesRequest();
        $request->name = "Nome da Série";
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        // Act
        $result = $repository->add($request);

        // Assert 
        $result = $this->assertDatabaseHas("series", ['name' => 'Nome da Série']);
        $result = $this->assertDatabaseHas("seasons", ['number' => 1]);
        $result = $this->assertDatabaseHas("episodes", ['number' => 1]);
    }
}
