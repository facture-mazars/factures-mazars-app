<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NumeroMatricule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z\d]+$/', $value);
    }

    public function message()
    {
        return 'The :attribute must contain only letters and/or numbers.';
    }
}
