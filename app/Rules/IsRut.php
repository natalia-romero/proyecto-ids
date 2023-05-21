<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsRut implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $value)) return false;
        $rut = explode('-', $value);
        return strtolower($rut[1]) == IsRut::dv($rut[0]);
    }
    static function dv($T)
    {
        $M = 0;
        $S = 1;
        for (; $T; $T = floor($T / 10))
            $S = ($S + $T % 10 * (9 - $M++ % 6)) % 11;
        return $S ? $S - 1 : 'k';
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute no es válido';
    }
}
