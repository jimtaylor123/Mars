<?php

namespace App\Http\Controllers;

use App\Models\Rover;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoverResource;
use App\Http\Resources\RoverCollection;
use App\Http\Requests\StoreRoverRequest;
use App\Http\Requests\UpdateRoverRequest;

class RoverController extends Controller
{
    public function index()
    {
        return RoverCollection::make(Rover::all())->additional([
            'message' => 'Here\'s a list of all the rovers on Mars',
        ]);
    }

    public function store(StoreRoverRequest $request)
    {
        $rover = Rover::create($request->validated());

        return RoverResource::make($rover)->additional([
            'message' => 'Great news, you\'ve just created a new Rover!',
        ]);
    }

    public function show(Rover $rover)
    {
        return RoverResource::make($rover)->additional([
            'message' => 'Here\'s the rover you asked for',
        ]);
    }

    public function update(UpdateRoverRequest $request, Rover $rover)
    {
        dd($request->toArray());
    }

}
