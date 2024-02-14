<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Religion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_islam',
        'is_kristen',
        'is_katolik',
        'is_hindu',
        'is_budha',
        'is_konghucu',
        'is_kaharingan',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}