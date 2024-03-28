<?php

namespace App\Models;

use App\Models\Issue;
use App\Models\IssueSolution;
use App\Models\ImplementationEvidance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueImplementation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'issue_id',
        'issue_solution_id',
        'name',
        'description',
        'date_implementation',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function issueSolution()
    {
        return $this->belongsTo(IssueSolution::class);
    }

    public function implementationEvidances()
    {
        return $this->hasMany(ImplementationEvidance::class);
    }
}
