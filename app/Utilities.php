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

    public function isBMIPassed($weight, $height): int
    {
        $bmi = $this->getBMIValue($weight, $height);
        return ($bmi >= 18.5 && $bmi <= 24.9) ? 20 : 0;
    }

    public function getSkillsFitnessResult(): int
    {
        $checks = [
            $this->fortyMeterSprinthResult <= 5.8,   // 5.8s or less
            $this->standingLongJumpResult >= 200,    // 200cm or more
            $this->hexagonAgilityResult <= 15.0,     // 15.0s or less
            $this->stickDropTestResult <= 11.5,      // 11.5cm or less
            $this->jugglingResult >= 30,             // 30s or more
            $this->storkBalanceStandResult >= 15,    // 15s or more
        ];

        // Pass if meet at least 4 out of 6
        return count(array_filter($checks)) >= 4 ? 40 : 0;
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
        return count(array_filter($checks)) >= 3 ? 40 : 0;
    }
}