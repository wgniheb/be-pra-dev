<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrinkingWaterSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_sungai',
        'is_sumur',
        'is_air_hujan',
        'is_galon',
        'is_pamsimas',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
