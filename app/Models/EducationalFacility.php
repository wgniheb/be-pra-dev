<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalFacility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_paud',
        'is_tk',
        'is_sd',
        'is_smp',
        'is_sma',
        'is_pt',
    ];

    protected $casts = [
        'is_paud' => 'boolean',
        'is_tk' => 'boolean',
        'is_sd' => 'boolean',
        'is_smp' => 'boolean',
        'is_sma' => 'boolean',
        'is_pt' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
