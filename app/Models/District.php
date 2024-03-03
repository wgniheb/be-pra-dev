<?php

namespace App\Models;

use App\Models\StakeholderHasDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'city_id', 'province_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function village()
    {
        return $this->hasMany(Village::class);
    }

    public function stakeholderHasDistrict()
    {
        return $this->hasMany(StakeholderHasDistrict::class);
    }
}
