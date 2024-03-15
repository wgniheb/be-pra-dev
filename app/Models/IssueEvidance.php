<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueEvidance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'issue_id',
        'evidance',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
