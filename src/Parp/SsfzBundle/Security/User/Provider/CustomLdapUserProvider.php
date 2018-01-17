<?php
namespace Parp\SsfzBundle\Security\User\Provider;

use Symfony\Component\Security\Core\User\LdapUserProvider;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Provider uzytkowników uwierzytelnianych przez LDAP
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class CustomLdapUserProvider extends LdapUserProvider
{

    /**
     *
     * @var UserService
     */
    private $userService;

    /**
     * Konstruktor
     * 
     * @param UserService                                 $userService
     * @param \Symfony\Component\Ldap\LdapClientInterface $ldap
     * @param string                                      $baseDn
     * @param string                                      $searchDn
     * @param string                                      $searchPassword
     * @param array                                       $defaultRoles
     * @param string                                      $uidKey
     * @param string                                      $filter
     */
    public function __construct($userService, \Symfony\Component\Ldap\LdapClientInterface $ldap, $baseDn, $searchDn, $searchPassword, array $defaultRoles = array(), $uidKey = 'sAMAccountName', $filter = '({uid_key}={username})')
    {
        parent::__construct($ldap, $baseDn, $searchDn, $searchPassword, $defaultRoles, $uidKey, $filter);
        $this->ldap = $ldap;
        $this->userService = $userService;
        $this->baseDn = $baseDn;
        $this->searchDn = $searchDn;
        $this->searchPassword = $searchPassword;
        $this->defaultSearch = str_replace('{uid_key}', $uidKey, $filter);
    }
    
    /**
     * Metoda pobierająca użytkownika.
     * Jeśli użytkownik zostaje prawidłowo pobrany,
     * zostaje mu nadana rola ROLE_BENEFICJENT.
     * 
     * @param  type $username
     * @param  type $user
     * @return \Symfony\Component\Security\Core\User\User
     */
    public function loadUser($username, $user)
    {
        $password = isset($user['userpassword']) ? $user['userpassword'] : null;
        $dbUser = $this->userService->getUzytkownikRepository()->loadUserByUsername($username);
        $roles = array();
        if (!is_null($dbUser)) {
            array_push($roles, $dbUser[0]->getRola()->getNazwa());
        }

        return new \Symfony\Component\Security\Core\User\User($username, $password, $roles);
    }
    /**
     * 
     * @param string $username
     * @return function
     * @throws UsernameNotFoundException
     */
    public function loadUserByUsername($username)
    {
        try {
            $this->ldap->bind($this->searchDn, $this->searchPassword);
            $username = $this->ldap->escape($username, '', LDAP_ESCAPE_FILTER);
            $query = str_replace('{username}', $username, $this->defaultSearch);
            $search = $this->ldap->find($this->baseDn, $query);
        } catch (ConnectionException $e) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username), 0, $e);
        }

        if (0 === $search['count']) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        if (1 !== $search['count']) {
            throw new UsernameNotFoundException('More than one user found');
        }

        $user = $search[0];

        return $this->loadUser($username, $user);
    }
     
     
}
