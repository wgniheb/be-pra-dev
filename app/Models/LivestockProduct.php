<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LivestockProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_unggas',
        'is_ternak_besar',
        'is_ternak_kecil',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
