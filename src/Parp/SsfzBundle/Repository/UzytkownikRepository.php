<?php
namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\Rola;

/**
 * UzytkownikRepository
 */
class UzytkownikRepository extends EntityRepository implements UserProviderInterface
{

    /**
     * Dodanie nowego użytkownika do bazy danych
     *
     * @param \Parp\SsfzBundle\Entity\Uzytkownik $user
     * @return Uzytkownik
     */
    public function persist(Uzytkownik $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();

        return $user;
    }

    /**
     * Dodaje nowego użytkownika
     *
     * @param Uzytkownik $user
     * @param Rola       $role
     */
    public function persistNewUser(Uzytkownik $user, Rola $role)
    {
        $user->newUser($role);
        $this->persist($user);
    }

    /**
     * Aktywuje konto użytkownika
     *
     * @param Uzytkownik $user
     */
    public function activateUserAccount(Uzytkownik $user)
    {
        $user->activateAccount();
        $this->persist($user);
    }

    /**
     * Ustawia kod zapomnianego hasła
     *
     * @param Uzytkownik $user
     */
    public function forgottenPassword(Uzytkownik $user)
    {
        $user->forgottenPassword();
        $this->persist($user);
    }

    /**
     * Ustawia nowe hasło
     *
     * @param Uzytkownik $user
     * @param string     $newPassword
     */
    public function newPassword(Uzytkownik $user, $newPassword)
    {
        $user->newPassword($newPassword);
        $this->persist($user);
    }

    /**
     * Metoda umożliwiająca pobranie tablicy adresów email
     * wszystkich użytkowników z rolą ROLE_PRACOWNIK_PARP
     *
     * @return array
     */
    public function getPracownicyAdresyEmailArray()
    {
        return array_column(
            $adresy = $this->getEntityManager()
            ->createQuery(
                'SELECT u.email FROM SsfzBundle:Uzytkownik u JOIN SsfzBundle:Rola r WITH u.rola = r.id where r.nazwa = \'ROLE_PRACOWNIK_PARP\''
            )
            ->getResult(), 'email'
        );
    }

    /**
     * Metoda pobierająca użytkownika ze wskazanym loginem
     *
     * @param  string $username
     * @return User
     * @throws UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findBy(['login' => $username]);
        if (!$user) {
            throw new UsernameNotFoundException('No user found for username ' . $username);
        }

        return $user;
    }

    /**
     * Sprawdza czy podany login uzytkownika istnieje
     *
     * @param  string $login
     * @return bool
     */
    public function loginIstnieje($login)
    {
        return count($this->findBy(['login' => $login])) == 1;
    }

    /**
     * Wyszukuje użytkowników po rolach
     *
     * @param string $role
     * @return array
     */
    public function znajdzPoRolach($role)
    {
        return $this->createQueryBuilder('u')
                ->where('u.rola in (?1)')
                ->setParameter(1, $role)
                ->getQuery()
                ->getResult();
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return User
     * @throws UnsupportedUserException
     * @throws UsernameNotFoundException
     */
    public function refreshUser(\Symfony\Component\Security\Core\User\UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.', $class
                )
            );
        }

        if (!$refreshedUser = $this->find($user->getId())) {
            throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($user->getId())));
        }

        return $refreshedUser;
    }

    /**
     * @param Class $class
     *
     * @return $class
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }
}
