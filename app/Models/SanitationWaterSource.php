<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanitationWaterSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_sungai',
        'is_sumur',
        'is_air_hujan',
        'is_pamsimas',
    ];

    protected $casts = [
        'is_sungai' => 'boolean',
        'is_sumur' => 'boolean',
        'is_air_hujan' => 'boolean',
        'is_pamsimas' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
