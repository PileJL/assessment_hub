<?php

namespace App;

trait Utilities
{
    public function getBMIValue($weight, $height): float
    {
        if ($height <= 0) return 0;
        
        return round($weight / ($height * $height), 2);
    }


    public function getBMICategory($weight, $height): string
    {
        $bmi = $this->getBMIValue($weight, $height);

        return match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi <= 24.9 => 'Normal',
            $bmi <= 29.9 => 'Overweight',
            $bmi >= 30.0 => 'Obese',
            default => 'Unknown',
        };
    }

    public function isBMIPassed($weight, $height): bool
    {
        $bmi = $this->getBMIValue($weight, $height);
        return ($bmi >= 18.5 && $bmi <= 24.9);
    }

    public function getSkillsFitnessResult(): int
    {
        // Criteria for Passing (Aggregated "Average" Benchmarks):
        $checks = [
            $this->agilityTtestResult <= 11.5,      // Sub 11.5 seconds
            $this->standingLongJumpResult >= 200,   // At least 200 cm
            $this->hexagonAgilityResult <= 15.0,    // Sub 15 seconds
            $this->fortyYardDashResult <= 5.8,      // Sub 5.8 seconds
            $this->storkBalanceStandResult >= 15,   // Hold for 15+ seconds
        ];

        // Pass if they meet at least 4 out of 5 skills
        return count(array_filter($checks)) >= 4 ? 1 : 0;
    }

    public function getHealthFitnessResult(): int
    {
        // Criteria for Passing:
        $checks = [
            $this->pushUpsResult >= 20,             // 20+ reps
            $this->sitAndReachResult >= 25,         // 25+ cm
            $this->threeMinStepResult <= 100,       // Recovery heart rate below 100 bpm
            $this->plankTestResult >= 60,           // 60+ seconds
        ];

        // Pass if they meet at least 3 out of 4 health metrics
        return count(array_filter($checks)) >= 3 ? 1 : 0;
    }
}