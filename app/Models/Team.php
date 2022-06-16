<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model {

    const STATUS_PREPARING = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_NEEDPAYMENT = 3;
    const STATUS_CLOSED = 4;
    const STATUS_CANCELLED = 5;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'email',
        'phone_number',
        'playing_field_id',
        'instructor'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function playingField() {
        return $this->belongsTo(PlayingField::class);
    }
}
