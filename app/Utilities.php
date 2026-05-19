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

    public function getStickDropTestResult(float $result): int
    {
        if ($result >= 0 && $result <= 2.4) return 5;
        else if ($result >= 5.08 && $result <= 10.16) return 4;
        else if ($result >= 12.70 && $result <= 17.78) return 3;
        else if ($result >= 20.32 && $result <= 25.40) return 2;
        else if ($result >= 27.94 && $result <= 30.48) return 1;
        else return 0;
    }

    public function getStandingLongJumpResult(float $result): int
    {
        if ($result >= 201) return 5;
        else if ($result >= 151 && $result <= 200) return 4;
        else if ($result >= 126 && $result <= 150) return 3;
        else if ($result >= 101 && $result <= 125) return 2;
        else if ($result >= 55 && $result <= 100) return 1;
        else return 0;
    }

    public function getHexagonAgilityResult(float $result): int
    {
        if ($result <= 5) return 5;
        else if ($result >= 6 && $result <= 10) return 4;
        else if ($result >= 11 && $result <= 15) return 3;
        else if ($result >= 16 && $result <= 20) return 2;
        else if ($result >= 25) return 1;
        else return 0;
    }

    public function get40meterSprintResult(float $result): int
    {
        if ($result <= 4.5) return 5;
        else if ($result >= 4.6 && $result <= 5.9) return 4;
        else if ($result >= 6.0 && $result <= 7.0) return 3;
        else if ($result >= 7.1 && $result <= 8.1) return 2;
        else if ($result >= 8.2) return 1;
        else return 0;
    }

    public function getStorkBalanceResult(float $result): int
    {
        if ($result >= 161 && $result <= 180) return 5;
        else if ($result >= 121 && $result <= 160) return 4;
        else if ($result >= 81 && $result <= 120) return 3;
        else if ($result >= 41 && $result <= 80) return 2;
        else if ($result >= 1 && $result <= 40) return 1;
        else return 0;
    }

    public function getJugglingResult(float $result): int
    {
        if ($result >= 41) return 5;
        else if ($result >= 31 && $result <= 40) return 4;
        else if ($result >= 21 && $result <= 30) return 3;
        else if ($result >= 11 && $result <= 20) return 2;
        else if ($result >= 1 && $result <= 10) return 1;
        else return 0;
    }

    public function getPushUpResult(float $result): int
    {
        if ($result >= 33) return 5;
        else if ($result >= 25 && $result <= 32) return 4;
        else if ($result >= 17 && $result <= 24) return 3;
        else if ($result >= 9 && $result <= 6) return 2;
        else if ($result >= 1 && $result <= 8) return 1;
        else return 0;
    }

    public function getSitAndReachResult(float $result): int
    {
        if ($result >= 61) return 5;
        else if ($result >= 46 && $result <= 60.9) return 4;
        else if ($result >= 31 && $result <= 45.9) return 3;
        else if ($result >= 16 && $result <= 30.9) return 2;
        else if ($result >= 0 && $result <= 15.9) return 1;
        else return 0;
    }

    public function getPlankResult(float $result): int
    {
        if ($result >= 51) return 5;
        else if ($result >= 46 && $result <= 50) return 4;
        else if ($result >= 31 && $result <= 45) return 3;
        else if ($result >= 16 && $result <= 30) return 2;
        else if ($result >= 1 && $result <= 15) return 1;
        else return 0;
    }

    public function getScoreEquivalent(int $score): string
    {
        if ($score === 5) return 'Excellent';
        else if ($score === 4) return 'Very Good';
        else if ($score === 3) return 'Good';
        else if ($score === 2) return 'Fair';
        else if ($score === 1) return 'Needs Improvement';
        else return 'Poor';
    }
}