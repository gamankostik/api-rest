<?php

namespace Tests\Unit;

use App\Models\City;
use BadMethodCallException;
use Tests\TestCase;

class CityTest extends TestCase
{
    public function __call($method, $args)
    {
        if (in_array($method, ['get', 'post', 'put', 'delete'])) {
            return $this->call($method, $args[0]);
        }

        throw new BadMethodCallException;
    }

    public function testCreateCity()
    {
        $data = [
            'name' => 'Palm Springs',
            'latitude' => 33.830517,
            'longitude' => -116.545601
        ];

        $this->post(route('cities.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function testUpdateCity()
    {
        $city = factory(City::class)->create([
            'name' => 'Palm Springs',
            'latitude' => 33.830517,
            'longitude' => -116.545601
        ]);

        $data = [
            'name' => 'Palm',
            'latitude' => 33.83111,
            'longitude' => -116.54111
        ];

        $this->put(route('cities.update', $city->id), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function testShowCity()
    {
        $city = factory(City::class)->create([
            'name' => 'Palm Springs',
            'latitude' => 33.830517,
            'longitude' => -116.545601
        ]);

        $this->get(route('cities.show', $city->id))
            ->assertStatus(200);
    }

    public function testDeleteCity()
    {
        $city = factory(City::class)->create([
            'name' => 'Palm Springs',
            'latitude' => 33.830517,
            'longitude' => -116.545601
        ]);

        $this->delete(route('cities.destroy', $city->id))
            ->assertStatus(204);
    }

    public function testListCities()
    {
        $this->get(route('cities.index'))
            ->assertStatus(201);
    }
}
