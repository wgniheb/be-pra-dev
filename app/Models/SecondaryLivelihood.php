<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SecondaryLivelihood extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_karyawan_swasta',
        'is_pns',
        'is_wirausaha',
        'is_penggarap_lahan',
        'is_nelayan',
    ];

    protected $casts = [
        'is_karyawan_swasta' => 'boolean',
        'is_pns' => 'boolean',
        'is_wirausaha' => 'boolean',
        'is_penggarap_lahan' => 'boolean',
        'is_nelayan' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
