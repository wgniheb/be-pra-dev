<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlantationCrop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_sawit',
        'is_karet',
        'is_kelapa',
        'is_kopi',
        'is_kakao',
        'is_lada',
    ];

    public function communityProfilingDetails(){
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
