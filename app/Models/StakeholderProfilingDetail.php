<?php

namespace App\Models;

use App\Models\StakeholderProfiling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderProfilingDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'stakeholder_profiling_id',
        'k_s1_q1',
        'k_s1_q2',
        'k_s1_q3',
        'k_s1_q4',
        'k_s1_q5',
        'k_s2_q1',
        'k_s2_q2',
        'k_s2_q3',
        'k_s2_q4',
        'k_s2_q5',
        'k_s2_q6',
        'k_s2_q7',
        'k_s2_q8',
        'p_s1_q1',
        'p_s1_q2',
        'p_s1_q3',
        'p_s1_q4',
        'p_s1_q5',
        'p_s1_q6',
        'p_s1_q7',
        'p_s2_q1',
        'p_s2_q2',
        'p_s2_q3',
        'p_s2_q4',
        'p_s2_q5',
        'p_s2_q6',
        'p_s2_q7',
    ];

    public function stakeholderProfiling()
    {
        return $this->belongsTo(StakeholderProfiling::class);
    }
}
