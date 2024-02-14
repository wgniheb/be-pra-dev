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

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
