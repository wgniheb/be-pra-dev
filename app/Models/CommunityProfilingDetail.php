<?php

namespace App\Models;

use App\Models\Idm;
use App\Models\Demographic;
use App\Models\FarmProduct;
use App\Models\HealthcareWorker;
use App\Models\CommunityProfiling;
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
        'plantation_crop_id'
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
}
