<?php

namespace App\Models;

use App\Models\StakeholderHasCity;
use App\Models\StakeholderHasProvince;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stakeholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone_number' ,'stakeholder_category_id'];

    public function stakeholderCategory()
    {
        return $this->belongsTo(StakeholderCategory::class);
    }

    public function stakeholderHasProvince()
    {
        return $this->hasMany(StakeholderHasProvince::class);
    }

    public function stakeholderHasCity()
    {
        return $this->hasMany(StakeholderHasCity::class);
    }

    public function stakeholderHasDistrict()
    {
        return $this->hasMany(StakeholderHasDistrict::class);
    }

    public function stakeholderHasVillage()
    {
        return $this->hasMany(StakeholderHasVillage::class);
    }

    public function stakeholderProfiling()
    {
        return $this->hasMany(StakeholderProfiling::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
