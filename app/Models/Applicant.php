<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Guarded;

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

    protected function casts(): array
    {
        return [
            'height' => 'float',
            'weight' => 'float',
        ];
    }

    public function skillsFitness()
    {
        return $this->hasOne(SkillsFitness::class, 'applicantID', 'applicantID');
    }

    public function healthFitness()
    {
        return $this->hasOne(HealthFitness::class, 'applicantID', 'applicantID');
    }
}
