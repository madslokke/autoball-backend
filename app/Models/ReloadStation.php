<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReloadStation extends Model {

    use SoftDeletes;


    protected $table = 'reload_stations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bullets',
        'playing_field_id'
    ];

    public function playingField() {
        return $this->belongsTo(PlayingField::class);
    }
}
