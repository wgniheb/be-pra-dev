<?php

namespace App\Models;

use App\Models\StakeholderHasProvince;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stakeholder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone_number' ,'stakeholder_category_id'];

    public function stakeholderCategory()
    {
        return $this->belongsTo(StakeholderCategory::class);
    }

    public function stakeholderHasProvince()
    {
        return $this->hasMany(StakeholderHasProvince::class);
    }
}
