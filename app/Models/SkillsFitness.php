<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Guarded;

#[Table(
    name: 'skills_fitnesses',
    key: 'skillsFitnessID',
    keyType: 'int',
    incrementing: true,
    timestamps: false,
)]
#[Guarded(['skillsFitnessID'])]
class SkillsFitness extends Model
{
    /** @use HasFactory<\Database\Factories\SkillsFitnessFactory> */
    use HasFactory;

    protected $casts = [
        'agilityTtestResult' => 'float',
        'standingLongJumpResult' => 'float',
        'hexagonAgilityResult' => 'float',
        'fortyYardDashResult' => 'float',
        'storkBalanceStandResult' => 'float',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicantID', 'applicantID');
    }
}
