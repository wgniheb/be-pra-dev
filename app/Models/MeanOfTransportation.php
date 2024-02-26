<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeanOfTransportation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_bus',
        'is_angkot',
        'is_sepeda_motor',
        'is_mobil',
        'is_perahu',
        'is_becak',
        'is_kereta_api',
    ];

    protected $casts = [
        'is_bus' => 'boolean',
        'is_angkot' => 'boolean',
        'is_sepeda_motor' => 'boolean',
        'is_mobil' => 'boolean',
        'is_perahu' => 'boolean',
        'is_becak' => 'boolean',
        'is_kereta_api' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
