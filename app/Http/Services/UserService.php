<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function create($body) {
        $user = new User();

        try {
            foreach ($body as $field => $value) {
                $user->$field = $value;

                if (!$value) {
                    return response()->json(['error' => "O campo '$field' precisa ser preenchido"], 400);
                }

                if ($field == 'count') {
                    $resCount = User::where($field, $value)->get();

                    if(count($resCount) > 0) {
                        return response()->json(['error' => "Já existe um usuário criado com a conta informada!"], 400);
                    }
                }
            }

            $user->save();

            return response()->json(['success' => 'Usuário criado com sucesso!']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function update($body, $id) {
        $user = User::find($id);

        try {
            foreach ($body as $field => $value) {
                $user->$field = $value;

                if (!$value) {
                    return response()->json(['error' => "O campo '$field' precisa ser preenchido"], 400);
                }

                if ($field == 'count') {
                    $resCount = User::where($field, $value)->get();

                    if(count($resCount) > 0 && $resCount[0]['id'] != $id) {
                        return response()->json(['error' => "Já existe um usuário com a conta informada!"], 400);
                    }
                }
            }

            $user->save();

            return response()->json(['success' => 'Usuário atualizado com sucesso!']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }

    public function findOne($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado!'], 400);
        }

        return $user;
    }

    public function userMovements($id, $type = null) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado!'], 400);
        }

        if ($type != null) {
            if ($type != 'd' && $type != 's' && $type != 'qd') {
                return response()->json(['error' => 'O tipo informado não é válido.'], 400);
            }

            $result = $user->movements->where('type', $type);

            if (count($result) == 0) {
                switch ($type) {
                    case 'd':
                        $message = 'realizou nenhum depósito';
                        break;
                    case 's':
                        $message = 'realizou nenhum saque';
                        break;
                    case 'qd':
                        $message = 'quitou nenhuma dívida';
                        break;
                }
                
                return response()->json(['error' => "Este usuário ainda não $message!"], 400);
            }

        } else {
            $result = $user->movements;

            if (count($result) == 0) {
                return response()->json(['error' => 'Este usuário ainda não realizou movimentações!'], 400);
            }
        }

        return $result;
    }

    public function userBalance($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado!'], 400);
        }

        $user->balance = number_format($user->balance, 2);

        return response()->json(['success' => "Seu saldo é: R$ $user->balance"]);
    }
}
