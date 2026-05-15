<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Builder;

#[Table(
    name: 'applicants',
    key: 'applicantID',
    keyType: 'int',
    incrementing: false,
    timestamps: false,
)]
#[Guarded([''])]
class Applicant extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicantFactory> */
    use HasFactory;

    protected $casts = [
        'timestampCreatedAt' => 'datetime',
        'height' => 'float',
        'weight' => 'float',
    ];

    public function skillsFitness()
    {
        return $this->hasOne(SkillsFitness::class, 'applicantID', 'applicantID');
    }

    public function healthFitness()
    {
        return $this->hasOne(HealthFitness::class, 'applicantID', 'applicantID');
    }

    public function scopeByApplicantID(Builder $query, string $applicantID)
    {
        return $query->when($applicantID, fn(Builder $q) => $q->where('applicantID', $applicantID));
    }

    public function scopeByApplicantName(Builder $query, ?string $fullName)
    {
        return $query->when($fullName, function (Builder $q) use ($fullName) {
            $q->where('fullName', 'like', '%' . $fullName . '%');
        });
    }
}
