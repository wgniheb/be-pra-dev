<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['year', 'score', 'idm_status_id'];

    public function idmStatus()
    {
        return $this->belongsTo(IdmStatus::class);
    }

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
