<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Parp\SsfzBundle\Constraints\NumerUmowyWalidator;
use Parp\SsfzBundle\Entity\Slownik\Program;

/**
 * Walidator numeru umowy.
 */
class NumerUmowy extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Nieprawidłowy numer umowy dla wybranego programu.';

    /**
     * @var Program
     */
    public $program = null;

    /**
     * Zwraca FQCN klasy wykonującej sprawdzenie.
     
     * @return string
     */
    public function validatedBy()
    {
        return NumerUmowyValidator::class;
    }
}
