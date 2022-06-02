<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Product;
use App\Models\Weapon;
use Illuminate\Http\Request;

class PlayerController extends Controller {

    public function getPlayerByWeaponId($playerId) {
        $player = Player::query()->find($playerId);

        $product = Product::query()->find($player->product_id);
        return [
            'player' => $player,
            'product' => $product
        ];
    }

    public function refillWeapon($playerId) {
        $player = Player::query()->find($playerId);
        $product = Product::query()->find($player->product_id);
        if ($product->bullets <= $player->bullets) {
            return [
                'status' => 'error',
                'error' => 'hit limit of bullets'
            ];
        }

        $player->bullets += 100;
        $player->save();
        return [
            'status' => 'success'
        ];
    }

}
