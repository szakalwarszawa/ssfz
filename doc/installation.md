## Wymagane narzędzia

Yarn - narzędzie do zarządzania zależnościami we frontendzie https://yarnpkg.com/lang/en/

Composer 

PHP 5.6
z rozszerzeniami:
ldap, json, mbstring, mysql, xml, curl


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

10. Konfigurujemy aplikację edytując plik app/config/parameters.yml. Głównie są tam typowe opcje konfiguracyjne opisane w dokumentacji Symfony. Specyficzne opcje konfiguracyjne są opisane w komentarzach.

11. Generujemy schemat bazy danych
php app/console doctrine:schema:update --force

12. Ładujemy dane podstawowe do bazy danych aplikacji
php app/console doctrine:fixtures:load

13. W konfiguracji aplikacji w parametrze 'jasper_ssfz_report_path' definiujemy docelową ścieżkę, pod którą znajdują się raporty.

14. Na serwerze JasperReports, w katalogu skojarzonym ze ścieżką skonfigurowaną w 'jasper_ssfz_report_path' umieszczamy plik "Raport nr 1.jrxml", znajdujący się pod ścieżką src/Parp/SsfzBundle/Resources/Samples, po czym na serwerze konfigurujemy "Data Source", czyli bazę danych. Podpinamy źródło danych do pliku "Raport nr 1.jrxml".

15. Aby uruchomić wysyłkę powiadomień należy do crontaba dodać następujący wpis:
5 * * * * php [sciezka_do_aplikacji]/app/console sfz:sendRemind

##Opcje konfiguracyjne

Znajdują się w pliku app/config/parameters.yml. 

database_host - adres serwera bazy danych MySQL
database_port - port serwera MySQL
database_name - nazwa bazy danych
database_user - użytkownik bazy danych
database_password - hasło użytkownika bazy danych

mailer_transport - określa sposób wysyłki przesyłek e-mail. Dostępne wartości: smtp, mail, gmail, null (wyłączenie transportu)
mailer_host - serwer wysłający metodą określona w mailer_transport
mailer_port - port serwera
mailer_user - login użytkownika wysyłającego przesyłki
mailer_password - hasło użytkownika wysyłającego przesyłki
mailer_encryption - sposób szyfrowania komunikacji w przypadku mailer_transport: smtp. Mozliwe wartości ssl, tls, none (brak szyfrowania)

powiadomienie_nadawca - zawartość pola "From" w przesyłkach z powiadomieniem  

secret - unikalny ciąg znaków specyficzny dla instalacji oprogramowania, służący głównie do generowania tokenów CSRF 

# LDAP-AD
# Uwaga! Po uzupełnieniu nazwy użytkownika można usunąć jeden znak "@" (podwójny znak
# zabezpiecza przed uznaniem niepełnej nazwy użytkownika za nazwę usługi wg. konwencji nazw Sf2.

ldap - konfiguracja serwera ActiveDirectory służącego do uwierzytelnienia i pobierania pracowników PARP. Tablica ta przekazywana jest do usługi LdapDataService, ale poszczególne parametry w innych usługach łączących się z serwerem AD. 
- host - adres serwera AD
- port - port serwera AD
- networkTimeout - maksymalny czas 
- allowEmptyPassword - czy dozwolone puste hasła
    username - nazwa użytkownika stosowanego do pobierania informacji o pracownikach PARP
    password - hasło uzytkownika
    bindRequiresDn: false
    accountDomainName: parp.local
    baseDn: "OU=Zespoly_2016,OU=PARP Pracownicy,DC=parp,DC=local"
ldap_version: 3
ldap_ssl: false
ldap_tls: false
# pole LDAP bedące loginem użytkownika
ldap_uid_key: 'samaccountname'
# Szablon określający gdzie szukać uzytkowników w drzewie LDAP
ldap_user_dn_string: "CN={username},OU=Zespoly_2016,OU=PARP Pracownicy,DC=parp,DC=local"
default_password_encoder: bcrypt

# Konfiguracja klienta JasperReports
jasper_host: http://localhost:8080/jasperserver
jasper_user: jasperadmin
jasper_password: jasperadmin
jasper_org_id:
jasper_ssfz_report_path: '/reports/parp'

# Parametry bazy danych do testów, analogicznie jak w ustawieniach bazy danych
test_database_host
test_database_port
test_database_name
test_database_user
test_database_password

# miesiąc i dzień (mm-dd) w którym wysyłane są powiadomienia o zaległych sprawozdaniach (dwa terminy) 
przypomnienie_pierwszy_termin_miesiac_dzien - pierwszy termin mm-dd
przypomnienie_drugi_termin_miesiac_dzien - drugi termin mm-dd

