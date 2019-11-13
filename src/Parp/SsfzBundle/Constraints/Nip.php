<?php

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Nip constraint
 */
class Nip extends Constraint
{
    public $komunikat = 'Nieprawidłowy numer NIP';

    /**
     * Zwraca nazwę klasy walidatora.
     *
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
