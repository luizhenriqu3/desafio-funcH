<?php

namespace App\Http\Services;

use App\Http\Services\UserService;
use App\Models\Movement;
use App\Models\User;

class MovementService
{
    public function executeMovement($type, $count, $value){
        $userService = new UserService;

        if (!is_numeric($value)) {
            return response()->json(['error' => 'O valor informado não é válido.']);
        }

        if ($type != 'd' && $type != 's') {
            return response()->json(['error' => 'O tipo informado não é válido.']);
        }

        $user_data = $userService->findByAttribute('count', $count);

        if (count($user_data) == 0) {
            return response()->json(['error' => 'Conta não encontrada.']);
        }

        $user = User::find($user_data[0]['id']);

        $balance = (float) $user_data[0]['balance'];

        $movement = new Movement;

        if ($type == 'd') {
            $user->balance = $balance+$value;
            $user->save();

            $movement->value   = $value;
            $movement->type    = $type;
            $movement->user_id = $user->id;
            $movement->save();

            $value = number_format($value, 2);
            $balance = number_format($user->balance, 2);
            return response()->json(['success' => "Depósito de R$ $value feito com sucesso. Seu novo saldo é: R$ $balance"]);
        }

        if ($type == 's') {
            $user->balance = $balance-$value;
            $user->save();

            $movement->value   = $value;
            $movement->type    = $type;
            $movement->user_id = $user->id;
            $movement->save();

            $value = number_format($value, 2);
            $balance = number_format($user->balance, 2);
            return response()->json(['success' => "Saque de R$ $value feito com sucesso. Seu novo saldo é: R$ $balance"]);
        }
    }
}
