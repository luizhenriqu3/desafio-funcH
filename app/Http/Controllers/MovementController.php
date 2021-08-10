<?php

namespace App\Http\Controllers;

use App\Http\Services\MovementService;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new MovementService;
    }

    public function executeMovement(Request $request, $args){
        $count = $request->input('count');
        $value = $request->input('value');

        return $this->service->executeMovement($args, $count, $value);
    }
}
