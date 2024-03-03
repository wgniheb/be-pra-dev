<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StakeholderKuadran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stakeholder_kuadrans';

    protected $fillable = [
        'name',
        'description',
    ];
}
