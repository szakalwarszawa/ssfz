#Testowanie aplikacji

Do testowania aplikacji użyto oprogramowania phpunit. 
Do wielu testów potrzebna jest baza danych testowa. Po wykonaniu testu, jest ona usuwana i przywracana z danymi z fixtures z pliku src/Parp/SsfzBundle/DataFixtures/ORM/Fixtures.php. Konfiguracja bazy testowej znajduje się w pliku parameters.yml - pozycje rozpoczynające się od: test_.

Przed rozpoczęciem testów należy przejść do katalogu app i uruchomić komendę phpunit
