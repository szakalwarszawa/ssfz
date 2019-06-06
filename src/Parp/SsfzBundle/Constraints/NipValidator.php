<?php
/**
 * Created by PhpStorm.
 * User: muchar
 * Date: 29.08.2015
 * Time: 02:18.
 */

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NipValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $wynik = $this->czyNip($value);
        if (true !== $wynik) {
            $this->context->addViolation($constraint->komunikat);
        }

        return $wynik;
    }

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
