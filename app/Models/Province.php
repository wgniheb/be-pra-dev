<?php

namespace App\Models;

use App\Models\StakeholderHasProvince;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function stakeholderHasProvince()
    {
        return $this->hasMany(StakeholderHasProvince::class);
    }
}
