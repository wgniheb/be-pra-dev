<?php

namespace App\Models;

use App\Models\District;
use App\Models\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderHasDistrict extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_id',
        'district_id'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
