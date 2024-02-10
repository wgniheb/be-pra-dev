<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityProfilingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'community_profiling_id',
        'idm_id',
    ];

    public function communityProfiling()
    {
        return $this->belongsTo(CommunityProfiling::class);
    }

    public function idm()
    {
        return $this->belongsTo(Idm::class);
    }
}
