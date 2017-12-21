<?php

namespace Parp\SsfzBundle\Security\User\Provider;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Klasa LsiUserProvider.
 *
 * Ładuje obiekty implementujące interfejs Symfony\Component\Security\Core\User\UserInterface
 * z bazy danych (warstwą pośredniczącą jest Doctrine2 ORM) na użytek systemu uwierzytelniania.
 *
 * Rozszerza klasę EntityUserProvider:
 *
 * @see http://api.symfony.com/2.3/Symfony/Bridge/Doctrine/Security/User/EntityUserProvider.html
 */
class LsiUserProvider extends EntityUserProvider implements UserProviderInterface
{
    /**
     * LsiUserProvider constructor.
     *
     * @param ManagerRegistry $registry
     * @param string          $class
     * @param string          $property
     */
    public function __construct(ManagerRegistry $registry, $class, $property = null)
    {
        parent::__construct($registry, $class, $property, null);
    }
}
