<?php

namespace Parp\SsfzBundle\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * PhoneNumberRequired constraint.
 *
 * One phone number is always required.
 */
class PhoneNumberRequired extends Constraint
{
    public $message = 'Należy podać przynajmniej jeden numer telefonu.';

    /**
     * Returns validator class name.
     *
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
