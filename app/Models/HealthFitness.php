<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Guarded;

#[Table(
    name: 'health_fitnesses',
    key: 'healthFitnessID',
    keyType: 'int',
    incrementing: true,
    timestamps: false,
)]
#[Guarded(['healthFitnessID'])]
class HealthFitness extends Model
{
    /** @use HasFactory<\Database\Factories\HealthFitnessFactory> */
    use HasFactory;

    protected $casts = [
        'pushUpsResult' => 'integer',
        'threeMinStepResult' => 'integer',
        'sitAndReachResult' => 'float',
        'plankTestResult' => 'float',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicantID', 'applicantID');
    }
}
