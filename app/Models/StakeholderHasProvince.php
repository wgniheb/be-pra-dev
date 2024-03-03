<?php

namespace App\Models;

use App\Models\Province;
use App\Models\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderHasProvince extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stakeholder_has_provinces';

    protected $fillable = [
        'stakeholder_id',
        'province_id'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
