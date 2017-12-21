# Instalacja oprogramowania SSFZ

## Wymagane narzędzia

Yarn - narzędzie do zarządzania zależnościami we frontendzie https://yarnpkg.com/lang/en/

Composer - narzędzie do zarządzania zaleznościami PHP https://getcomposer.org/

PHP 5.6
z rozszerzeniami:
ldap, json, mbstring, mysql, xml, curl

## Biblioteki wykorzystane w aplikacji

Wersja i nazwa zgodne z konwencją Composer.

doctrine/doctrine-bundle - wersja ~1.4,  
doctrine/orm - wersja ^2.4.8,  
incenteev/composer-parameter-handler - wersja ~2.0,  
jaspersoft/rest-client - wersja ^2.0,  
nesbot/carbon - wersja ^1.22,  
phpmetrics/phpmetrics - wersja ~1.10.0,  
sensio/distribution-bundle - wersja ~4.0,  
sensio/framework-extra-bundle - wersja ^3.0.2,  
svajiraya/ldap-bundle - wersja ^2.4,  
symfony/assetic-bundle - wersja ^2.8,  
symfony/ldap - wersja ^3.3,  
symfony/monolog-bundle - wersja ^3.0.2,  
symfony/swiftmailer-bundle - wersja ~2.3,>=2.3.10,  
symfony/symfony - wersja 2.8.*,  
twig/twig - wersja ^1.0||^2.0,  
waldo/datatable-bundle - wersja ^4.0,  
zendframework/zend-ldap - wersja ~2.4  

Dodatkowo w środowisku devel:

doctrine/doctrine-fixtures-bundle - wersja ^2.4,  
leaphub/phpcs-symfony2-standard - wersja ^2.0,  
overtrue/phplint - wersja ^0.2.4,  
phpmd/phpmd - wersja @stable,  
phpunit/phpunit - wersja ~5.7.23,  
sensio/generator-bundle - wersja ~3.0,  
squizlabs/php_codesniffer - wersja *,  
symfony/phpunit-bridge - wersja ~2.7  


## Instalacja

1. Kopiujemy kod źródłowy do wybranego katalogu, konfigurujemy serwer HTTP (document root w podkatalogu web). Następne komendy wykonujemy z katalogu z kodem źródłowym.

2. Instalujemy zależności projektu:  
composer install

3. Instalujemy zależności do frontendu:  
yarn --cwd=src/Parp/SsfzBundle/Resources/public/ install

4. Instalujemy assety  
php app/console assets:install

5. Wykonujemy zrzut assetów z Assetic-a  
php app/console assetic:dump

6. Czyścimy cache  
php app/console cache:clear -e prod

7. Może wystąpić potrzeba ustawienia grupy serwera www na katalogu z cache  
chgrp grupa_serwera -R app/cache

8. Dodajemy bazę danych (MySQL) na potrzeby aplikacji  

9. Tworzymy konfigurację aplikacji  
cp app/config/parameters.yml.dist app/config/parameters.yml

10. Konfigurujemy aplikację edytując plik app/config/parameters.yml. Więcej informacji o opcjach konfiguracyjnych w rozdziale [Opcje konfiguracyjne](Opcje konfiguracyjne)

11. Generujemy schemat bazy danych  
php app/console doctrine:schema:update --force

12. Ładujemy dane podstawowe (słowniki, domyslny administrator admin - domyslne_haslo) do bazy danych aplikacji  
php DatabaseSeeder.php 

13. W konfiguracji aplikacji w parametrze 'jasper_ssfz_report_path' definiujemy docelową ścieżkę, pod którą znajdują się raporty.

14. Na serwerze JasperReports, w katalogu skojarzonym ze ścieżką skonfigurowaną w 'jasper_ssfz_report_path' umieszczamy plik "Raport nr 1.jrxml", znajdujący się pod ścieżką src/Parp/SsfzBundle/Resources/Samples, po czym na serwerze konfigurujemy "Data Source", czyli bazę danych. Podpinamy źródło danych do pliku "Raport nr 1.jrxml".

##Opcje konfiguracyjne

Znajdują się w pliku app/config/parameters.yml. 

**database_host** - adres serwera bazy danych MySQL  
**database_port** - port serwera MySQL  
**database_name** - nazwa bazy danych  
**database_user** - użytkownik bazy danych  
**database_password** - hasło użytkownika bazy danych  

**mailer_transport** - określa sposób wysyłki przesyłek e-mail. Dostępne wartości: smtp, mail, gmail, null (wyłączenie transportu)  
**mailer_host** - serwer wysłający metodą określona w mailer_transport  
**mailer_port** - port serwera  
**mailer_user** - login użytkownika wysyłającego przesyłki  
**mailer_password** - hasło użytkownika wysyłającego przesyłki  
**mailer_encryption** - sposób szyfrowania komunikacji w przypadku mailer_transport: smtp. Mozliwe wartości ssl, tls, none (brak szyfrowania)  

**powiadomienie_nadawca** - zawartość pola "From" w przesyłkach z powiadomieniem  

**secret** - unikalny ciąg znaków specyficzny dla instalacji oprogramowania, służący głównie do generowania tokenów CSRF 

**ldap** - konfiguracja serwera ActiveDirectory służącego do uwierzytelnienia i pobierania pracowników PARP. Tablica ta przekazywana jest do usługi LdapDataService, ale poszczególne parametry w innych usługach łączących się z serwerem AD. 

* **host** - adres serwera AD
* **port** - port serwera AD
* **networkTimeout** - maksymalny czas 
* **allowEmptyPassword** - czy dozwolone puste hasła
* **username** - nazwa użytkownika stosowanego do pobierania informacji o pracownikach PARP
* **password** - hasło uzytkownika
* **bindRequiresDn** - 
* **accountDomainName** - domena kont pracowników PARP
* **baseDn** - ścieżka w której są pracownicy PARP w AD

**ldap_version** - wersja protokołu LDAP
**ldap_ssl** - czy komunikacja LDAP szyfrowana ssl
**ldap_tls** - czy komunikacja LDAP szyfrowana tls
**ldap_uid_key** - pole rekordu LDAP w którym przechowywany jest login użytkownika (ten wpisywany w formularzu logowania) 
**ldap_user_dn_string** - szablon określający to co jest podawane podczas logowania LDAP jako nazwa użytkownika w {username} jest wpisywane to co użytkownik podaje w formularzu logowania

**default_password_encoder** - określa sposób hashowania haseł w bazie danych. Dostępne wartości sha512, pbkdf2, bcrypt

**jasper_host** - adres serwera Jasper Reports
**jasper_user** - nazwa użytkownika Jasper Reports
**jasper_password** - hasło użytkownika serwera Jasper Reports
**jasper_org_id** - nazwa organizacji
**jasper_ssfz_report_path** - ścieżka serwera Jasper Reports w której będą raporty dla SSFZ


**test_database_host** - adres serwera MySQL z bazą przeznaczoną do testów  
**test_database_port** - port serwera MySQL do testów  
**test_database_name** - nazwa bazy danych do testow  
**test_database_user** - użytkownik przy pomocy którego łączymy się z bazą testową  
**test_database_password** - hasło użytkownika przy pomocy którego łączymy się z bazą testową