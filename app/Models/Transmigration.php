<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transmigration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_lokal',
        'is_transmigrasi',
    ];

    protected $casts = [
        'is_lokal' => 'boolean',
        'is_transmigrasi' => 'boolean',
    ];

    public function communityProfilingDetails()
    {
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
