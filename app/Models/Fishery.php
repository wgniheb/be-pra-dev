<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fishery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_perikanan_budidaya',
        'is_perikanan_tangkap',
    ];

    protected $casts = [
        'is_perikanan_budidaya' => 'boolean',
        'is_perikanan_tangkap' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
