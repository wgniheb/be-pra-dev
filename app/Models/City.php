<?php

namespace App\Models;

use App\Models\StakeholderHasCity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->hasMany(District::class);
    }

    public function village()
    {
        return $this->hasMany(Village::class);
    }

    public function stakeholderHasCity()
    {
        return $this->hasMany(StakeholderHasCity::class);
    }
}
