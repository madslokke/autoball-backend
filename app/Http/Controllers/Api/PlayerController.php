<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Product;
use App\Models\Weapon;

class PlayerController extends Controller {

    public function getPlayerByWeaponId($nfcId) {
        $weapon = Weapon::query()->where('nfc_id', '=', $nfcId)->firstOrFail();
        $player = Player::query()->where('weapon_id', '=', $weapon->id)->orderBy('created_at', 'desc')->firstOrFail();
        $product = Product::query()->find($player->product_id);

        return [
            'player' => $player,
            'product' => $product,
            'weapon' => $weapon,
        ];
    }

    public function refillWeapon($nfcId) {
        $weapon = Weapon::query()->where('nfc_id', '=', $nfcId)->firstOrFail();
        $player = Player::query()->where('weapon_id', '=', $weapon->id)->orderBy('created_at', 'desc')->firstOrFail();
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
