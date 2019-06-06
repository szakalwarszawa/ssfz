<?php

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;

class Nip extends Constraint
{
    public $komunikat = 'Nieprawidłowy numer NIP';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
