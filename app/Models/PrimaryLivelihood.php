<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrimaryLivelihood extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_petani',
        'is_pekebun',
        'is_pns',
        'is_karyawan_swasta',
        'is_wirausaha',
        'is_nelayan',
        'is_jasa',
    ];

    protected $casts = [
        'is_petani' => 'boolean',
        'is_pekebun' => 'boolean',
        'is_pns' => 'boolean',
        'is_karyawan_swasta' => 'boolean',
        'is_wirausaha' => 'boolean',
        'is_nelayan' => 'boolean',
        'is_jasa' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
