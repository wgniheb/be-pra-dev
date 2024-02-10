<?php

namespace App\Models;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'district_id', 'city_id', 'province_id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function communityProfilings()
    {
        return $this->hasMany(CommunityProfiling::class);
    }
}
