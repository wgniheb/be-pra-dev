<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_melayu',
        'is_jawa',
        'is_banjar',
        'is_batak',
        'is_minang',
        'is_dayak',
        'is_flores',
        'is_bugis',
        'is_papua',
        'is_manado',
        'is_toraja',
        'is_timor',
    ];

    protected $casts = [
        'is_melayu' => 'boolean',
        'is_jawa' => 'boolean',
        'is_banjar' => 'boolean',
        'is_batak' => 'boolean',
        'is_minang' => 'boolean',
        'is_dayak' => 'boolean',
        'is_flores' => 'boolean',
        'is_bugis' => 'boolean',
        'is_papua' => 'boolean',
        'is_manado' => 'boolean',
        'is_toraja' => 'boolean',
        'is_timor' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
