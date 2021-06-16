<?php

namespace App\Services;

use App\Models\Rover;

class RoverService
{
    private Rover $rover;
    private array $commandArray;

    public function drive(Rover $rover, string $commandString)
    {
        $this->rover = $rover;
        $this->commandArray = str_split($commandString);

        foreach ($this->commandArray as $command) {
            switch ($command) {
                case 'B':
                    $this->reverse();
                    break;
                case 'F':
                    $this->advance();
                    break;
                case 'R':
                    $this->turnRight();
                    break;
                case 'L':
                    $this->turnLeft();
                    break;
            }
        }

        $this->rover->save();

        return "($rover->x,$rover->y) $rover->direction";
    }

    private function reverse()
    {
        $this->rover->x -= 1;
    }

    private function advance()
    {
        $this->rover->x += 1;
    }

    private function turnRight()
    {
        switch ($this->rover->direction) {
            case 'NORTH':
                $this->rover->direction = 'EAST';
                break;
            case 'EAST':
                $this->rover->direction = 'SOUTH';
                break;
            case 'SOUTH':
                $this->rover->direction = 'WEST';
                break;
            case 'WEST':
                $this->rover->direction = 'NORTH';
                break;
        }
    }

    private function turnLeft()
    {
        switch ($this->rover->direction) {
            case 'NORTH':
                $this->rover->direction = 'WEST';
                break;
            case 'EAST':
                $this->rover->direction = 'NORTH';
                break;
            case 'SOUTH':
                $this->rover->direction = 'EAST';
                break;
            case 'WEST':
                $this->rover->direction = 'SOUTH';
                break;
        }
    }
}
