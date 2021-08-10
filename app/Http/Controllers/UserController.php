<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserService;
    }

    public function all(){
        $result = User::all();

        if (count($result) == 0) {
            return response()->json(['error' => 'Nenhum usuário encontrado.']);
        }

        return response()->json($result);
    }

    public function create(Request $request){
        $body = $request->input();

        $result = $this->service->create($body);

        return $result;
    }

    public function update(Request $request, $args) {
        $body = $request->input();
        $user_id = $args;

        $result = $this->service->update($body, $user_id);

        return $result;
    }

    public function findOne($args){
        $result = $this->service->findOne($args);

        return $result;
    }

    public function userMovements($id, $type = null) {
        $result = $this->service->userMovements($id, $type);

        return $result;
    }

    public function userBalance($args){
        $result = $this->service->userBalance($args);

        return $result;
    }
}
