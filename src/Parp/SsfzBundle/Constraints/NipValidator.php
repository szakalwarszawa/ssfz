<?php

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Klasa NipValidator
 */
class NipValidator extends ConstraintValidator
{
    /**
     * Walidacja NIP.
     *
     * @param string $value
     * @param Constraint $constraint
     *
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        $wynik = $this->czyNip($value);
        if (true !== $wynik) {
            $this->context->addViolation($constraint->komunikat);
        }

        return $wynik;
    }

    /**
     * Informuje, czy podany ciąg znaków jest prawidłowym NIP.
     *
     * @param string $str
     *
     * @return bool
     */
    public function czyNip($str)
    {
        $str = preg_replace('/[^0-9]+/', '', $str);
        if (strlen($str) != 10) {
            return false;
        }

        $arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
        $intSum = 0;
        for ($i = 0; $i < 9; ++$i) {
            $intSum += $arrSteps[$i] * $str[$i];
        }
        $int = $intSum % 11;

        $intControlNr = ($int == 10) ? 0 : $int;
        if ($intControlNr == $str[9]) {
            return true;
        }

        return false;
    }
}
