<?php

namespace App\Models;

use App\Models\Idm;
use App\Models\Fishery;
use App\Models\LandUse;
use App\Models\Demographic;
use App\Models\FarmProduct;
use App\Models\PlantationCrop;
use App\Models\EconomicFacility;
use App\Models\HealthcareWorker;
use App\Models\LivestockProduct;
use App\Models\CommunityProfiling;
use App\Models\DrinkingWaterSource;
use App\Models\SanitationWaterSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityProfilingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'community_profiling_id',
        'idm_id',
        'demographic_id',
        'healthcare_worker_id',
        'farm_product_id',
        'plantation_crop_id',
        'livestock_product_id',
        'fishery_id',
        'drinking_water_source_id',
        'sanitation_water_source_id',
        'land_use_id',
        'economic_facility_id',
    ];

    public function communityProfiling()
    {
        return $this->belongsTo(CommunityProfiling::class);
    }

    public function idm()
    {
        return $this->belongsTo(Idm::class);
    }

    public function demographic()
    {
        return $this->belongsTo(Demographic::class);
    }

    public function healthcareWorker()
    {
        return $this->belongsTo(HealthcareWorker::class);
    }

    public function farmProduct()
    {
        return $this->belongsTo(FarmProduct::class);
    }

    public function plantationCrop()
    {
        return $this->belongsTo(PlantationCrop::class);
    }

    public function livestockProduct()
    {
        return $this->belongsTo(LivestockProduct::class);
    }

    public function fishery()
    {
        return $this->belongsTo(Fishery::class);
    }

    public function drinkingWaterSource()
    {
        return $this->belongsTo(DrinkingWaterSource::class);
    }

    public function sanitationWaterSource()
    {
        return $this->belongsTo(SanitationWaterSource::class);
    }

    public function landUse()
    {
        return $this->belongsTo(LandUse::class);
    }

    public function economicFacility()
    {
        return $this->belongsTo(EconomicFacility::class);
    }
}
