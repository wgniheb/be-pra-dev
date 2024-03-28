<?php

namespace App\Models;

use App\Models\IssueImplementation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImplementationEvidance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'implementation_id',
        'evidance',
    ];

    public function implementation()
    {
        return $this->belongsTo(IssueImplementation::class);
    }
}
