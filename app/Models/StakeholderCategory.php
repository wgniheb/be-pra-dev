<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function stakeholders()
    {
        return $this->hasMany(Stakeholder::class);
    }
}
