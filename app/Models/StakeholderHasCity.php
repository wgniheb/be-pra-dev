<?php

namespace App\Models;

use App\Models\City;
use App\Models\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderHasCity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_id',
        'city_id'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
