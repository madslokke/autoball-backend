<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Model {

    use SoftDeletes;

    protected $fillable = [
        'email',
        'token',
        'role_id',
        'company_id'
    ];
}
