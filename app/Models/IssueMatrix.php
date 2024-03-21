<?php

namespace App\Models;

use App\Models\IssueAnalysis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueMatrix extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function issueAnalyses()
    {
        return $this->hasMany(IssueAnalysis::class);
    }
}
