<?php

namespace App\Models;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IssueCategory extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
