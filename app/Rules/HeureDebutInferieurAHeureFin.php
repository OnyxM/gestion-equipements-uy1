<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HeureDebutInferieurAHeureFin implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $heureDebut = request()->input('heure_debut');
        $heureFin = request()->input('heure_fin');

        if ($heureDebut >= 7 && $heureDebut <= 20 && $heureFin >= 7 && $heureFin <= 20 && $heureDebut >= $heureFin) {
            $fail("L'heure de début doit être inférieure à l\'heure de fin et les deux valeurs doivent être comprises entre 7 et 20.");
        }
    }
}
