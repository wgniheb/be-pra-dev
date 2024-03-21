<?php

namespace App\Models;

use App\Models\Issue;
use App\Models\IssueMatrix;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueAnalysis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'issue_id',
        'matrix_id',
        'score',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function matrix()
    {
        return $this->belongsTo(IssueMatrix::class);
    }
}
