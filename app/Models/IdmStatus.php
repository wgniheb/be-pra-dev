<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdmStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function idms()
    {
        return $this->hasMany(Idm::class);
    }
}
