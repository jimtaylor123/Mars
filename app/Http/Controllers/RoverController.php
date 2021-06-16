<?php

namespace App\Http\Controllers;

use App\Models\Rover;
use Illuminate\Http\Request;
use App\Http\Resources\RoverResource;
use App\Http\Resources\RoverCollection;

class RoverController extends Controller
{
    public function index()
    {
        return RoverCollection::make(Rover::all())->additional([
            'message' => 'Here\'s a list of all the rovers on Mars',
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Rover $rover)
    {
        return RoverResource::make($rover)->additional([
            'message' => 'Here\'s the rover you asked for',
        ]);
    }

    public function update(Request $request, Rover $rover)
    {
        //
    }

}
