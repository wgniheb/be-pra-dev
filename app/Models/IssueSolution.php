<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueSolution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'issue_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'target',
        'notes',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
