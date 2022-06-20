<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'weapon_id',
        'product_id'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'bullets' => 0,
    ];

    public function weapon() {
        return $this->belongsTo(Weapon::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function team() {
        return $this->belongsTo(Product::class);
    }
}
