<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Rover;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoverTest extends TestCase
{
    /**
     * @test
     */
    public function anyone_can_list_all_rovers()
    {
        $response = $this->get('/rovers');
        $response->assertSuccessful();
        $response->assertJsonPath('message', "Here's a list of all the rovers on Mars");
        $response->assertJsonCount(Rover::count(), 'data');
        $this->assertNotEmpty($response->json()['data'][Rover::inRandomOrder()->first()->id]['id']);
    }

    /**
     * @test
     */
    public function anyone_can_show_a_rover()
    {
        $rover = Rover::inRandomOrder()->first();
        $response = $this->get("/rovers/$rover->id");
        $response->assertSuccessful();
        $response->assertJsonPath('message', "Here's the rover you asked for");
        $response->assertJsonCount(6, 'data');
        $this->assertEquals($response->json()['data']['id'], $rover->id);
        $this->assertEquals($response->json()['data']['x'], $rover->x);
        $this->assertEquals($response->json()['data']['y'], $rover->y);
        $this->assertEquals($response->json()['data']['direction'], $rover->direction);
    }

    /**
     * @test
     */
    public function requesting_a_rover_that_doesnt_exist_returns_not_found()
    {
        $notARover = Rover::orderBy('id', 'DESC')->first()->id + 1;
        $response = $this->get("/rovers/$notARover");
        $response->assertSeeText('404');
        $response->assertSeeText('Not Found');
    }

    /**
     * @test
     */
    public function anyone_can_create_a_rover()
    {
        $data = Rover::factory()->raw();
        $response = $this->post('/rovers', $data);
        $response->assertStatus(201);
        $response->assertJsonPath('message', "Great news, you've just created a new Rover!");
        $response->assertJsonCount(6, 'data');
        $this->assertEquals($response->json()['data']['x'], $data['x']);
        $this->assertEquals($response->json()['data']['y'], $data['y']);
        $this->assertEquals($response->json()['data']['direction'], $data['direction']);
    }

     /**
     * @test
     * @dataProvider requiredRoverCreationData
     */
    public function cant_create_a_rover_without_the_right_data(string $field)
    {
        $data = Rover::factory()->raw();
        unset($data[$field]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/rovers', $data);

        $response->assertStatus(422);

        $response->assertJsonPath('message', "The given data was invalid.");
        $response->assertJsonPath("errors.$field.0", "The $field field is required.");
    }

    public function requiredRoverCreationData(): array
    {
        return [
           ['x'], ['y'], ['direction']
        ];
    }
}
