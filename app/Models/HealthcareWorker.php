<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthcareWorker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_dokter',
        'is_perawat',
        'is_mantri',
        'is_bidan',
        'is_dukun',
    ];

    protected $casts = [
        'is_dokter' => 'boolean',
        'is_perawat' => 'boolean',
        'is_mantri' => 'boolean',
        'is_bidan' => 'boolean',
        'is_dukun' => 'boolean',
    ];

    public function communityProfilingDetails(){
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
