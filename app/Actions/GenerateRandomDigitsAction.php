<?php

namespace App\Actions;

class GenerateRandomDigitsAction
{
    public function __invoke(int $length): string
    {
        $random_digits = '';

        for ($i = 0; $i < $length; $i++) {
            $random_digits .= mt_rand(0, 9); // Append a random digit (0-9)
        }

        return $random_digits;
    }
}
