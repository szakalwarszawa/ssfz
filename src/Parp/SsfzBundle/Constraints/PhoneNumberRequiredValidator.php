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
     * Sprawdza czy podano przynajmniej jeden numer telefonu.
     *
     * W praktyce przekazywana do sprawdzenia wartość jest bez znaczenia.
     * Walidacja odbywa się na poziomie całej encji przypiętej do fomularza.
     * Sprawdzane jest czy obiekt posiada dane o telefonie komórkowym i/lub stancjonarnym.
     *
     * @param string $value
     * @param Constraint $constraint
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function validate($value, Constraint $constraint)
    {
        $isValid = false;

        $data = $this
            ->context
            ->getRoot()
            ->getData()
        ;
        if (is_object($data) && method_exists($data, 'getTelStacjonarny') && method_exists($data, 'getTelKomorkowy')) {
            $telStacjonarny = (string) $data->getTelStancjonarny();
            $telKomorkowy = (string) $data->getTelKomorkowy();

            $isValid = ($telStacjonarny.$telKomorkowy !== '');
        }

        if (!$isValid) {
            $this->context->addViolation($constraint->message);
        }

        return $isValid;
    }
}
