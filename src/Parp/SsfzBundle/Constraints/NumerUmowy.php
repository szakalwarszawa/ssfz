<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Parp\SsfzBundle\Constraints\NumerUmowyValidator;
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
     * @var string
     */
    public $messageFunduszZalazkowy = 'Oczekiwany format numeru umowy: POIG.03.01.00-00-NNN/RR-UU; gdzie: NNN-trzycyfrowy numer wniosku, RR-dwucyfrowy numer roku złożenia wniosku, UU-musi przyjmować wartość 00.';

    /**
     * @var string
     */
    public $messageFunduszPozyczkowy = 'Oczekiwany format numeru umowy: WKP_1/1.2.1/X/RRRR/YY/ZZ/u; gdzie: X-jednocyfrowy numer rundy naboru, RRRR-rok złożenia wniosku, YY-dwucyfrowy numer, ZZ-dwucyfrowy numer.';

    /**
     * @var string
     */
    public $messageFunduszPoreczeniowy = 'Oczekiwany format numeru umowy: WKP_1/1.2.2/X/RRRR/YY/ZZ/u; gdzie: X-jednocyfrowy numer rundy naboru, RRRR-rok, YY-dwucyfrowy numer, ZZ-dwucyfrowy numer.';

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
