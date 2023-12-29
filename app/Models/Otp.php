<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'otp',
        'user_id',
        'request_time',
        'expired_time',
        'verified_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
