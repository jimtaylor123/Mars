<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Rover;

class DriveRoverTest extends TestCase
{
  private array $validCommands = [
    [
      'BBRFLL', [
        'SW' => '(4,2) SOUTH',
        'SE' => '(4,2) SOUTH',
        'NW' => '(4,2) SOUTH',
        'NE' => '(4,2) SOUTH',
      ]
    ],
    [
      'BB R  FL     L', [
        'SW' => '(4,2) SOUTH',
        'SE' => '(4,2) SOUTH',
        'NW' => '(4,2) SOUTH',
        'NE' => '(4,2) SOUTH',
      ]
    ],
    [
      'bbrfll', [
        'SW' => '(4,2) SOUTH',
        'SE' => '(4,2) SOUTH',
        'NW' => '(4,2) SOUTH',
        'NE' => '(4,2) SOUTH',
      ]
    ],
    [
      'b  br   fl     l', [
        'SW' => '(4,2) SOUTH',
        'SE' => '(4,2) SOUTH',
        'NW' => '(4,2) SOUTH',
        'NE' => '(4,2) SOUTH',
      ]
    ],
    [
      'LBFFRRFFFFRRLRBFLRBFLRBF', [
        'SW' => '(4,2) SOUTH',
        'SE' => '(4,2) SOUTH',
        'NW' => '(4,2) SOUTH',
        'NE' => '(4,2) SOUTH',
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
      $response->assertJsonPath("errors.commandString.0", "The command string must only contain the letters L, R, B and F");
    } else {
      $response->assertJsonPath("errors.commandString.0", "The command string field is required.");
    }
  }

  /**
   * @test
   * @dataProvider rovers
   */
  public function a__rover_can_be_driven_correctly_with_valid_commands()
  {
    foreach ($this->validCommands as $command) {
      // test the rover
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
      'SW_ROVER' => [
        -10, -20, 'SOUTH'
      ],
      'SE_ROVER' => [
        -10, -20, 'EAST'
      ],
      'SE_ROVER' => [
        -10, -20, 'EAST'
      ],
    ];
  }

  public function edgeCaseCommands(): array
  {
    return [];
  }
}
