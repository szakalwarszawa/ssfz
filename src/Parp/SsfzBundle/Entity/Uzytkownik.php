<?php

namespace Parp\SsfzBundle\Entity;

use Serializable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Carbon\Carbon;
use Parp\SsfzBundle\Entity\Slownik\Program;

/**
 * Uzytkownik
 *
 * @ORM\Table(name="sfz_uzytkownik")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\UzytkownikRepository")
 * @ORM\HasLifecycleCallbacks
 *
 * @UniqueEntity(fields="login", message="Login jest już w użyciu.")
 * @UniqueEntity(fields="email", message="Adres email jest już w użyciu.")
 */
class Uzytkownik implements AdvancedUserInterface, Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=64, unique=true)
     *
     * @Assert\NotBlank(groups={"rejestracja"})
     * @Assert\Length(groups={"rejestracja"}, max=64)
     * @Assert\Regex(groups={"rejestracja"}, pattern="/[0-9a-zA-Z]{5,}/", message="Pole login musi zawierać co
     * najmniej 5 znaków i nie więcej niż 255 znaków.")
     */
    protected $login;

    /**
     * @var string
     *
     * @ORM\Column(name="haslo", type="string", nullable=true)
     *
     * @Assert\NotBlank(groups={"rejestracja"})
     * @Assert\Length(max=255, groups={"rejestracja"})
     * @Assert\Regex(
     *  groups={"rejestracja"},
     *  pattern="/(?=.*[A-Z].*[A-Z])(?=.*[a-z])(?=.*[0-9].*[0-9])(?=.*[~!@#$&^&*()_+=\[\];',.<>?\/]).{8,}/",
      message="Hasło musi zawierać co najmniej
      8 znaków i maksymalnie 255,
      2 duże litery,
      2 cyfry,
      1 znak specjalny z zakresu: ~!@#$%^&*()_+=[];',.<>?/", groups={"rejestracja"})
     */
    protected $haslo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, unique=true)
     *
     * @Assert\NotBlank(groups={"rejestracja"})
     * @Assert\Email(groups={"rejestracja"}, message="Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres
     * nie zawiera błedów.")
     */
    protected $email;

    /**
     * @var Rola
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Rola")
     */
    protected $rola;

    /**
     * @var bool
     *
     * @ORM\Column(name="ban", type="boolean")
     */
    protected $ban;

    /**
     * @var string
     *
     * @ORM\Column(name="kod_zapomniane_haslo", type="string", nullable=true)
     */
    protected $kodZapomnianeHaslo;

    /**
     * @var Carbon\Carbon
     *
     * @ORM\Column(name="utworzony", type="datetime")
     */
    protected $utworzony;

    /**
     * @var Carbon\Carbon
     *
     * @ORM\Column(name="zmodyfikowany", type="datetime", nullable = true)
     */
    protected $zmodyfikowany;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * Encje Beneficjent powiązane z użytkownikiem.
     *
     * @ORM\OneToMany(targetEntity="Beneficjent", mappedBy="uzytkownik")
     */
    protected $beneficjenci;

    /**
     * @var string
     *
     * @ORM\Column(name="kod_aktywacja_konta", type="string", nullable=true)
     */
    protected $kodAktywacjaKonta;

    /**
     * @var string
     */
    protected $imie;

    /**
     * @var string
     */
    protected $nazwisko;

    /**
     * Program, do którego beneficjent aktualnie tworzy sprawozdanie.
     *
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\Program")
     */
    protected $aktywnyProgram;

    /**
     * Publiczny konstruktor
     */
    public function __construct()
    {
        $this->beneficjenci = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Get haslo
     *
     * @return string
     */
    public function getHaslo()
    {
        return $this->haslo;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get Rola
     *
     * @return Rola
     */
    public function getRola()
    {
        return $this->rola;
    }

    /**
     * Get ban
     *
     * @return bool
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * Get kodZapomnianeHaslo
     *
     * @return string
     */
    public function getKodZapomnianeHaslo()
    {
        return $this->kodZapomnianeHaslo;
    }

    /**
     * Get utworzony
     *
     * @return Carbon
     */
    public function getUtworzony()
    {
        return $this->utworzony;
    }

    /**
     * Get zmodyfikowany
     *
     * @return Carbon
     */
    public function getZmodyfikowany()
    {
        return $this->zmodyfikowany;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getKodAktywacjaKonta()
    {
        return $this->kodAktywacjaKonta;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $haslo
     */
    public function setHaslo($haslo)
    {
        $this->haslo = $haslo;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param Rola $rola
     */
    public function setRola($rola)
    {
        $this->rola = $rola;
    }

    /**
     * @param bool $ban
     */
    public function setBan($ban)
    {
        $this->ban = $ban;
    }

    /**
     * @param string $kodZapomnianeHaslo
     */
    public function setKodZapomnianeHaslo($kodZapomnianeHaslo)
    {
        $this->kodZapomnianeHaslo = $kodZapomnianeHaslo;
    }

    /**
     * @param Carbon $utworzony
     */
    public function setUtworzony(Carbon $utworzony)
    {
        $this->utworzony = $utworzony;
    }

    /**
     * @param Carbon $zmodyfikowany
     */
    public function setZmodyfikowany(Carbon $zmodyfikowany)
    {
        $this->zmodyfikowany = $zmodyfikowany;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $kodAktywacjaKonta
     */
    public function setKodAktywacjaKonta($kodAktywacjaKonta)
    {
        $this->kodAktywacjaKonta = $kodAktywacjaKonta;
    }

    /**
     * Zwraca informację czy użytkownik jest pracownikiem PARP
     *
     * Tzn. czy ma jedną z ról zdefiniowaną w Rola::NAZWY_ROL_PARP
     *
     * @return bool
     */
    public function czyPracownikParp()
    {
        return in_array($this->rola->getNazwa(), Rola::NAZWY_ROL_PARP);
    }

    /**
     * Wyzwalane przy operacji INSERT
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $salt = $this->generateSalt();

        $options = [
            'cost' => 12,
            'salt' => $salt,
        ];
        $this->haslo = $this->haslo !== null ? password_hash($this->haslo, PASSWORD_BCRYPT, $options) : $this->haslo;
        $this->ban = false;
        $this->status = 0;
        $this->utworzony = new Carbon('Europe/Warsaw');
    }

    /**
     * Wyzwalane przy operacji UPDATE
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->zmodyfikowany = new Carbon('Europe/Warsaw');
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->login;
    }


    /**
     * @return string
     */
    public function generateSalt()
    {
        return uniqid(mt_rand(), true);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->haslo;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array($this->getRola()->getNazwa());
    }

    /**
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * @param string $imie
     */
    public function setImie($imie)
    {
        $this->imie = $imie;
    }

    /**
     * @param string $nazwisko
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;
    }

    /**
     * Usuwa dane poufne z użytkownika
     */
    public function eraseCredentials()
    {
        $this->aktywnyProgram = null;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->login,
            $this->haslo,
            $this->email,
            $this->rola,
            $this->ban,
            $this->kodZapomnianeHaslo,
            $this->utworzony,
            $this->zmodyfikowany,
            $this->status,
            $this->kodAktywacjaKonta,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->haslo,
            $this->email,
            $this->rola,
            $this->ban,
            $this->kodZapomnianeHaslo,
            $this->utworzony,
            $this->zmodyfikowany,
            $this->status,
            $this->kodAktywacjaKonta,
        ) = unserialize($serialized);
    }

    /**
     *
     * @return bool
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     *
     * @return bool
     */
    public function isAccountNonLocked()
    {
        return ($this->ban === true) ? false : true;
    }

    /**
     *
     * @return bool
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (0 === $this->status) ? false : true;
    }

    /**
     * Aktywuje konto użytkownika
     */
    public function activateAccount()
    {
        $this->setStatus(1);
        $this->setKodAktywacjaKonta(null);
    }

    /**
     * Ustawia rolę nowemu użytkownikowi
     *
     * @param Rola $role
     */
    public function newUser(Rola $role)
    {
        $this->setRola($role);
        $this->setKodAktywacjaKonta(str_replace(array('/', '+', '='), '', base64_encode(random_bytes(64))));
    }

    /**
     * Generuje token do resetu hasła
     */
    public function forgottenPassword()
    {
        $this->setKodZapomnianeHaslo(str_replace(array('/', '+', '='), '', base64_encode(random_bytes(64))));
    }

    /**
     * Zmiana hasła
     *
     * @param string $newPassword
     */
    public function newPassword($newPassword)
    {
        $generatedSalt = $this->generateSalt();
        $this->setHaslo(password_hash($newPassword, PASSWORD_BCRYPT, array('cost' => 12, 'salt' => $generatedSalt)));
        $this->setKodZapomnianeHaslo(null);
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Set aktywnyProgram
     *
     * @param Program|null $aktywnyProgram
     *
     * @return Uzytkownik
     */
    public function setAktywnyProgram(Program $aktywnyProgram = null)
    {
        $this->aktywnyProgram = $aktywnyProgram;

        return $this;
    }

    /**
     * Get aktywnyProgram
     *
     * @return Program
     */
    public function getAktywnyProgram()
    {
        return $this->aktywnyProgram;
    }

    /**
     * Get aktywnyProgram
     *
     * @return int
     */
    public function getAktywnyProgramId()
    {
        return (null !== $this->aktywnyProgram)
            ? (int) $this->aktywnyProgram->getId()
            : 0
        ;
    }

    /**
     * Get beneficjenci
     *
     * @return Collection
     */
    public function getBeneficjenci()
    {
        return $this->beneficjenci;
    }

    /**
     * Add beneficjenci
     *
     * @param Beneficjent $beneficjenci
     *
     * @return Uzytkownik
     */
    public function addBeneficjenci(Beneficjent $beneficjenci)
    {
        $this->beneficjenci[] = $beneficjenci;

        return $this;
    }

    /**
     * Remove beneficjenci
     *
     * @param Beneficjent $beneficjenci
     */
    public function removeBeneficjenci(Beneficjent $beneficjenci)
    {
        $this->beneficjenci->removeElement($beneficjenci);
    }
    
    /**
     * Zwraca beneficjenta dla aktywnego programu.
     *
     * @return Beneficjent
     */
    public function getBeneficjent()
    {
        foreach ($this->beneficjenci as $beneficjent) {
            if ((int) $beneficjent->getProgram()->getId() === (int) $this->aktywnyProgram->getId()) {
                return $beneficjent;
            }
        }
        
        return null;
    }
    
    /**
     * Zostawione dla zgodności ze starym kodem.
     *
     * @param Beneficjent $beneficjent
     *
     * @return Uzytkownik
     */
    public function setBeneficjent(Beneficjent $beneficjent)
    {
        $beneficjent->setUzytkownik($this);
        
        return $this;
    }
}
