<?php

namespace Parp\SsfzBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model resetowania hasła
 */
class ResetLink
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=64)
     */
    private $login;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(message="Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres nie zawiera błędów.")
     */
    private $email;

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
