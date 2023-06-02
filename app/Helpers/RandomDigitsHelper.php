<?php

namespace App\Helpers;

/**
 * Invokable helper class to generate a string of random digits.
 */
class RandomDigitsHelper
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
