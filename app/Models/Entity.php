<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entity extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'address',
        'logo',
    ];

    public function userHasEntity()
    {
        return $this->hasMany(UserHasEntity::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
