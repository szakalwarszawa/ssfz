<?php

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validator for PhoneNumberRequired constraint.
 */
class PhoneNumberRequiredValidator extends ConstraintValidator
{
    /**
     * @param string $value
     * @param Constraint $constraint
     *
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        $isValid = false;
        if (is_object($value) && method_exists($value, 'getTelStacjonarny') && method_exists($value, 'getTelKomorkowy')) {
            $telStacjonarny = (string) $value->getTelStancjonarny();
            $telKomorkowy = (string) $value->getTelKomorkowy();

            $isValid = ($telStacjonarny.$telKomorkowy !== '');
        }

        if (!$isValid) {
            $this->context->addViolation($constraint->message);
        }

        return $isValid;
    }
}
