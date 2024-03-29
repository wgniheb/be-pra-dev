<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EconomicInstitution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_bank',
        'is_koperasi',
        'is_credit_union',
        'is_brilink',
    ];

    protected $casts = [
        'is_bank' => 'boolean',
        'is_koperasi' => 'boolean',
        'is_credit_union' => 'boolean',
        'is_brilink' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
