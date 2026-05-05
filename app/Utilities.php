<?php

namespace App;

trait Utilities
{
    public function getBMIresult($weight, $height): bool
    {
        $bmi = $weight / ($height * $height);
        return ($bmi >= 18.5 && $bmi <= 24.9);
    }
}
