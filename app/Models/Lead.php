<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Lead extends Model
{
    use HasFactory;
    use HasUuids;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'organization_id',
        'first_name',
        'last_name',
        'linkedin_url',
        'headline',
        'job_title',
        'company',
        'industry',
        'location',
        'email',
        'phone',
        'website',
        'lead_score',
        'status',
        'source',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'lead_score' => 'integer',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company' => $this->company,
            'job_title' => $this->job_title,
            'status' => $this->status,
            'source' => $this->source,
        ];
    }
}
