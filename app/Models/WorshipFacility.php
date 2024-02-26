<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorshipFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_masjid',
        'is_gereja_kristen',
        'is_gereja_katolik',
        'is_pura',
        'is_vihara',
        'is_balai_besarah',
    ];

    protected $casts = [
        'is_masjid' => 'boolean',
        'is_gereja_kristen' => 'boolean',
        'is_gereja_katolik' => 'boolean',
        'is_pura' => 'boolean',
        'is_vihara' => 'boolean',
        'is_balai_besarah' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
