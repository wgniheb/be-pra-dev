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

    public function communityProfilingDetails(){
        return $this->hasMany(CommunityProfilingDetail::class);
    }
}
