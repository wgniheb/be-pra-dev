<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityProfiling extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year',
        'village_id'
    ];

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
