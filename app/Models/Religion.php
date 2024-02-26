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

    protected $casts = [
        'is_islam' => 'boolean',
        'is_kristen' => 'boolean',
        'is_katolik' => 'boolean',
        'is_hindu' => 'boolean',
        'is_budha' => 'boolean',
        'is_konghucu' => 'boolean',
        'is_kaharingan' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
