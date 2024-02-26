<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CommunityProfilingDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FarmProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'is_padi',
        'is_palawija',
        'is_holtikultura',
    ];

    protected $casts = [
        'is_padi' => 'boolean',
        'is_palawija' => 'boolean',
        'is_holtikultura' => 'boolean',
    ];

    public function communityProfilingDetails(){
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
