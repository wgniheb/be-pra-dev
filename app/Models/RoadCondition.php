<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadCondition extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'is_aspal',
        'is_cor',
        'is_tanah',
        'is_batu',
    ];

    protected $casts = [
        'is_aspal' => 'boolean',
        'is_cor' => 'boolean',
        'is_tanah' => 'boolean',
        'is_batu' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
