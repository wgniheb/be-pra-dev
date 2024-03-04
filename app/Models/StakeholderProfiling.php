<?php

namespace App\Models;

use App\Models\Stakeholder;
use App\Models\StakeholderKuadran;
use Illuminate\Database\Eloquent\Model;
use App\Models\StakeholderProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderProfiling extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_id',
        'year',
        'stakeholder_kuadran_id',
        'power_point',
        'interest_point',
    ];

    protected $casts = [
        'power_point' => 'decimal:2',
        'interest_point' => 'decimal:2',
    ];

    public function stakeholderKuadran()
    {
        return $this->belongsTo(StakeholderKuadran::class);
    }

    public function stakeholderProfilingDetails()
    {
        return $this->hasMany(StakeholderProfilingDetail::class);
    }

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }
}
