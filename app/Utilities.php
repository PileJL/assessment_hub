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
}