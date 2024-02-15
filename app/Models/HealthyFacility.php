<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthyFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_posyandu',
        'is_puskesmas',
        'is_pustu',
        'is_polindes',
        'is_klinik',
        'is_rs',
        'is_poskesdes',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
