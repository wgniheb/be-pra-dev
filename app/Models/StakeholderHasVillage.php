<?php

namespace App\Models;

use App\Models\Village;
use App\Models\Stakeholder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderHasVillage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_id',
        'village_id'
    ];

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
