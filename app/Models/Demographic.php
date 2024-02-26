<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demographic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'jumlah_penduduk_laki_laki',
        'jumlah_penduduk_perempuan',
        'jumlah_penduduk_total',
        'luas_desa',
        'kepadatan_penduduk',
    ];

    protected $casts = [
        'kepadatan_penduduk' => 'integer',
    ];

    public function communityProfilingDetails(){
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
