<?php

namespace App\Http\Controllers;

use App\Http\Services\MovementService;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new MovementService;
    }

    public function all(){
        $result = Movement::all();

        if (count($result) == 0) {
            return response()->json(['error' => 'Nenhuma movimentação encontrada.'], 400);
        }

        return response()->json($result);
    }

    public function executeMovement(Request $request, $args){
        $count = $request->input('count');
        $value = $request->input('value');

        return $this->service->executeMovement($args, $count, $value);
    }
}
