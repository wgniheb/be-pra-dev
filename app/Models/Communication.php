<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Communication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_surat',
        'is_telephone',
        'is_handphone',
    ];

    protected $casts = [
        'is_surat' => 'boolean',
        'is_telephone' => 'boolean',
        'is_handphone' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
