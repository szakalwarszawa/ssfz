<?php

namespace Parp\SsfzBundle\Service;

use Exception;
use Parp\SsfzBundle\Entity\UzytkownikLdap;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zend\Ldap\Ldap;
use Parp\SsfzBundle\Exception\LdapDataServiceException;
use Parp\SsfzBundle\Repository\UzytkownikRepository;

/**
 * Klasa zapewniająca dostęp do danych zgromadzonych w bazie LDAP
 *
 * Umożliwia pobieranie informacji o użytkownikach
 */
class LdapDataService
{
    /**
     * Klasa \Zend\Ldap\Ldap reprezentuje wiązanie do pojedynczego serwera LDAP (OpenLDAP
     * lub ActiveDirectory) i pozwala na wykonanie na nim operacji.
     *
     * @see http://framework.zend.com/manual/current/en/modules/zend.ldap.introduction.html
     *
     * @var Ldap;
     */
    private $ldap;

    /**
     * Parametry połączenia z serwerem LDAP-AD.
     *
     * @var array
     */
    private $parameters;

    /**
     * Pole LADAP które jest loginem użytkownika
     */
    private $uidKey;

    /**
     * Publiczny konstruktor.
     *
     * @param array  $parameters
     * @param string $uidKey
     */
    public function __construct(array $parameters = array(), $uidKey = 'samaccountname')
    {
        $this->configureOptions($parameters);
        $ldap = new Ldap($this->parameters);
        $ldap->bind();
        $this->ldap = $ldap;

        $this->uidKey = $uidKey;
    }

    /**
     * Konfiguracja usługi (dostępu do LDAP-AD).
     *
     * Uwaga! Podanie wartości ppcji "username" w formacie "nazwaUzytkownika@domena" wymaga
     * ustawienia  opcji "bindRequiresDn" na wartość logiczną FAŁSZ.
     *
     * @see http://framework.zend.com/manual/current/en/modules/zend.ldap.introduction.html#automatic-username-canonicalization-when-binding
     *
     * @param array $parameters
     *
     * @return array
     */
    private function configureOptions($parameters)
    {
        $defaults = [
            'host'               => '',
            'port'               => 389,
            'networkTimeout'     => 10,
            'allowEmptyPassword' => false,
            'username'           => '',
            'password'           => '',
            'bindRequiresDn'     => false,
            'accountDomainName'  => '',
            'baseDn'             => '',
        ];
        $resolver = new OptionsResolver();
        $resolver->setDefaults($defaults);
        $parameters = $resolver->resolve($parameters);
        $this->parameters = $parameters;

        return $parameters;
    }

    /**
     * Publiczny akcesor opcji konfiguracji dostępu do LDAP-AD.
     *
     * @param string $optionName
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getOption($optionName, $defaultValue = null)
    {
        $result = $defaultValue;
        $options = $this->parameters;
        if (array_key_exists($optionName, $options)) {
            $result = $options[$optionName];
        }

        return $result;
    }

    /**
     * Pobiera z katalogu LDAP listę użytkowników
     *
     * Uzytkonik w liście jest reprezentowany przez klasę UzytkownikLdap. Użytkownicy są wyszukiwani
     * względem zdefiniowanego w konstruktorze baseDn.
     *
     * @return UzytkownikLdap[]
     */
    public function getUzytkownikLdapLista()
    {
        $result = array();
        $baseDn = $this->getOption('baseDn', '');
        $searchScope = Ldap::SEARCH_SCOPE_SUB;
        $employees = $this
            ->ldap
            ->searchEntries('objectClass=organizationalPerson', $baseDn, $searchScope);
        foreach ($employees as $employee) {
            $uzytkownikLdap = $this->convertLdapDataToUzytkownikLdap($employee);
            if (null !== $uzytkownikLdap) {
                $result[] = $uzytkownikLdap;
            }
        }
        //sortuje tablicę wg loginu
        uasort($result, function (UzytkownikLdap $uzytkownik1, UzytkownikLdap $uzytkownik2) {
            return strcmp($uzytkownik1->getLogin(), $uzytkownik2->getLogin());
        });

        return $result;
    }

    /**
     * Pobiera użytkowników z LDAP z ustawionym adresem e-mail
     *
     * Wybiera tylko uzytkowników z ustawionym polem mail. Zwraca tablicę z UzytkownikLdap
     *
     * @return UzytkownikLdap[]
     */
    public function getUzytkownikLdapListaZEmail()
    {
        $uzytkLdap = $this->getUzytkownikLdapLista();
        $out = array();
        foreach ($uzytkLdap as $u) {
            if (null === $u->getEmail()) {
                continue;
            }
            $out[] = $u;
        }

        return $out;
    }

    /**
     * Pobiera obiekt UzytkownikLdap na podstawie podanego loginu
     *
     * Zwraca obiekt UzytkownikLdap dla podanego loginu. W przypdku gdy login jest niejednoznaczny
     * tzn. więcej niż jeden rekord z LDAP pasuje do podanego loginu wyrzuca LdapDataServiceexception
     *
     * @param string $login
     *
     * @return UzytkownikLdap
     *
     * @throws LdapDataServiceException
     */
    public function getUzytkownikLdap($login)
    {

        $baseDn = $this->getOption('baseDn', '');
        $searchScope = Ldap::SEARCH_SCOPE_SUB;
        $employee = $this->ldap->searchEntries('(&(objectClass=organizationalPerson)(' . $this->uidKey . '=' . $login . '))', $baseDn, $searchScope);
        if (1 !== count($employee)) {
            throw new LdapDataServiceException('Niejednoznaczny login LDAP');
        }

        return $this->convertLdapDataToUzytkownikLdap($employee[0]);
    }

    /**
     * Zwraca tylko dostępnych użytkowników z LDAP
     *
     * Tzn. tylko tych który nie zostali już dodani do aplikacji
     *
     * @param UzytkownikRepository $uzytkRepo
     *
     * @return array
     */
    public function getDostepnychUzytkownikowLdap(UzytkownikRepository $uzytkRepo)
    {
        $wynik = [];
        $pracownicyLdap = $this->getUzytkownikLdapListaZEmail();
        $loginy = $this->pobierzLoginy($uzytkRepo);
        foreach ($pracownicyLdap as $pracownik) {
            if (in_array($pracownik->getLogin(), $loginy)) {
                continue;
            }
            $wynik[] = $pracownik;
        }

        return $wynik;
    }

    /**
     * Pobiera loginy użytkowników z Active Directory
     *
     * @param UzytkownikRepository $uzytkRepo
     *
     * @return array
     */
    private function pobierzLoginy($uzytkRepo)
    {
        $uzytkownicy = $uzytkRepo->findAll();
        $out = [];
        foreach ($uzytkownicy as $u) {
            $out[] = $u->getLogin();
        }

        return $out;
    }

    /**
     * Konwertuje tablicę z informacjami na temat użytkownika na obiekt UzytkonikLdap.
     *
     * Tablica konwertowana powinna mieć strukturę taką jaka pojawia sie na
     * wyjściu \Zend\Ldap\Ldap::searchEntries()
     *
     * @param array $data
     *
     * @return UzytkownikLdap
     */
    private function convertLdapDataToUzytkownikLdap($data)
    {
        $uzytkownikLdap = new UzytkownikLdap();
        $uzytkownikLdap->setLogin($data[$this->uidKey][0]);
        if (key_exists('mail', $data)) {
            $uzytkownikLdap->setEmail($data['mail'][0]);
        }
        if (key_exists('givenName', $data)) {
            $uzytkownikLdap->setImie($data['givenName'][0]);
        }
        if (key_exists('sn', $data)) {
            $uzytkownikLdap->setNazwisko($data['sn'][0]);
        }

        return $uzytkownikLdap;
    }
}
