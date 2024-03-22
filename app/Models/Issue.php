<?php

namespace App\Models;

use App\Models\Entity;
use App\Models\RiskIssue;
use App\Models\IssueStatus;
use App\Models\Stakeholder;
use App\Models\ImpactStatus;
use App\Models\IssueAnalysis;
use App\Models\IssueCategory;
use App\Models\IssueEvidance;
use App\Models\IssueSolution;
use App\Models\PublishedStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'issue_detail',
        'issue_category_id',
        'entity_id',
        'stakeholder_id',
        'published_status_id',
        'period',
        'stakeholder_perception',
        'issue_status_id',
        'impact_status_id',
        'risk_issue_id',
    ];

    public function issueCategory()
    {
        return $this->belongsTo(IssueCategory::class);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function stakeholder()
    {
        return $this->belongsTo(Stakeholder::class);
    }

    public function publishedStatus()
    {
        return $this->belongsTo(PublishedStatus::class);
    }

    public function issueStatus()
    {
        return $this->belongsTo(IssueStatus::class);
    }

    public function evidances()
    {
        return $this->hasMany(IssueEvidance::class);
    }

    public function impactStatus()
    {
        return $this->belongsTo(ImpactStatus::class);
    }

    public function riskIssue()
    {
        return $this->belongsTo(RiskIssue::class);
    }

    public function issueAnalyses()
    {
        return $this->hasMany(IssueAnalysis::class);
    }

    public function issueSolutions()
    {
        return $this->hasMany(IssueSolution::class);
    }
}
