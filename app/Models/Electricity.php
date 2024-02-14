<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Electricity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_pln',
        'is_non_pln',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
