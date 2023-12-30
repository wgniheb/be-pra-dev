<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'address',
    ];

    public function userHasEntity()
    {
        return $this->hasMany(UserHasEntity::class);
    }
}
