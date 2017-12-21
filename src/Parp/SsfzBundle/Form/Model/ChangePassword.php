<?php
namespace Parp\SsfzBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model zmiany hasła
 */
class ChangePassword
{

    /**
     * @var string
     */
    private $oldPassword;

    /**
     * @var string
     * 
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Assert\Regex(
     *  pattern="/(?=.*[A-Z].*[A-Z])(?=.*[a-z])(?=.*[0-9].*[0-9])(?=.*[~!@#$&^&*()_+=\[\];',.<>?\/]).{8,}/",
      message="Hasło musi zawierać co najmniej
      8 znaków i maksymalnie 255,
      2 duże litery,
      2 cyfry,
      1 znak specjalny z zakresu: ~!@#$%^&*()_+=[];',.<>?/")
     */
    private $newPassword;

    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param string $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @param string $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }
}
