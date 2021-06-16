<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Rover;

class DriveRoverTest extends TestCase
{
  private array $validCommands = [
    [
      'BBRFLL', [
        'SW' => '(-11,-20) EAST',
        'SE' => '(9,-20) WEST',
        'NW' => '(-11,20) SOUTH',
        'NE' => '(9,20) NORTH',
      ]
    ],
    [
      'BB R  FL     L', [
        'SW' => '(-11,-20) EAST',
        'SE' => '(9,-20) WEST',
        'NW' => '(-11,20) SOUTH',
        'NE' => '(9,20) NORTH',
      ]
    ],
    [
      'bbrfll', [
        'SW' => '(-11,-20) EAST',
        'SE' => '(9,-20) WEST',
        'NW' => '(-11,20) SOUTH',
        'NE' => '(9,20) NORTH',
      ]
    ],
    [
      'b  br   fl     l', [
        'SW' => '(-11,-20) EAST',
        'SE' => '(9,-20) WEST',
        'NW' => '(-11,20) SOUTH',
        'NE' => '(9,20) NORTH',
      ]
    ],
    [
      'LBFFRRFFFFRRLRBFLRBFLRBF', [
        'SW' => '(-5,-20) EAST',
        'SE' => '(15,-20) WEST',
        'NW' => '(-5,20) SOUTH',
        'NE' => '(15,20) NORTH',
      ]
    ],
  ];

  /**
   * @test
   * @dataProvider invalidCommands
   */
  public function a_rover_cannot_be_driven_with_an_invalid_command($invalidCommand)
  {
    $rover = Rover::inRandomOrder()->first();

    $response = $this->withHeaders([
        'Accept' => 'application/json',
    ])->patch("/rovers/$rover->id", [
      'commandString' => $invalidCommand
    ]);

    $response->assertStatus(422);

    $response->assertJsonPath('message', "The given data was invalid.");

    if(! empty(trim($invalidCommand))){
      $response->assertSeeText("The command string must only contain the letters L, R, B and F");
    } else {
      if($invalidCommand !== false){
        $response->assertSeeText("The command string field is required.");
      } else {
        $response->assertSeeText("The command string must be a string.");
      }
    }
  }

  /**
   * @test
   * @dataProvider rovers
   */
  public function a_rover_can_be_driven_correctly_with_valid_commands($x, $y, $direction, $quadrant)
  {
    foreach ($this->validCommands as $command) {
      // test the rover and compare to expected result
      $rover = Rover::factory()->create([
        'x' => $x,
        'y'=> $y,
        'direction' => $direction
      ]);

      $response = $this->withHeaders([
        'Accept' => 'application/json',
      ])->patch("/rovers/$rover->id", [
        'commandString' => $command[0]
      ]);

      $this->assertSame($command[1][$quadrant], $response->json()['current_status']);
    }
  }

  public function invalidCommands(): array
  {
    return [
      'empty string' => [''],
      'null' => [null],
      'whitespace string' => ['    '],
      'incorrect letters' => ['kohui'],
      'mixed letters lower case' => ['bhfrol'],
      'mixed letters lower case with spaces' => ['bh fro  l'],
      'mixed letters upper case' => ['DFBYTR'],
      'mixed letters upper case with spaces' => ['DF  BY TR'],
      'numbers' => ['019807787'],
      'integer' => [878966],
      'float' => [3.456],
      'boolean_true' => [true],
      'boolean_false' => [false],
    ];
  }

  public function rovers(): array
  {
    return [
      'SW' => [
        -10, -20, 'SOUTH', 'SW'
      ],
      'SE' => [
        10, -20, 'NORTH', 'SE'
      ],
      'NW' => [
        -10, 20, 'WEST', 'NW'
      ],
      'NE' => [
        10, 20, 'EAST', 'NE'
      ],
    ];
  }
}
