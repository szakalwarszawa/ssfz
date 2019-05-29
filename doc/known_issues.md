# Wykaz znanych problemów z działaniem, konfigurowaniem i tworzeniem aplikacji

### 29-05-2019 / 1
**Problem:** 
Konflikt między svajiraya/ldap-bundle a symfony/symfony po "composer update"
> Version v2.4.8  
> @svajiraya svajiraya released this on Apr 7  
> This release resolves PR#2 and PR#3.  
>     Dropped support for Symfony versions lower than 3.0  

**Rozwiązanie:**  
Zapis z composer.json "svajiraya/ldap-bundle": "^2.4" musiał zostać zmienony na "svajiraya/ldap-bundle": "2.4.7" (wersja na stałe, gdyż
była podnoszona do 2.4.8).  
**Todo:**  
Aplikacja SSFZ działa na Symfony 2.8.x i wymagana byłaby migracja do 3.x (aktualnie zbyt czasochłonna). W przyszłości, przy okazji migracji, można podnieść wersję svajiraya/ldap-bundle.

### 29-05-2019 / 2
**Problem:** 
Konflikt między symfony/ldap a symfony/symfony po "composer update"
> Installation request for symfony/ldap ^3.3 -> satisfiable by symfony/ldap[v3.3.0, v3.3.1... v3.4.9].

**Rozwiązanie:**  
Obniżenie wersji symfony/ldap w composer.json z "symfony/ldap": "^3.3" na "symfony/ldap": "^2.8".  
**Todo:**  
Aplikacja SSFZ działa na Symfony 2.8.x i wymagana byłaby migracja do 3.x (aktualnie zbyt czasochłonna). W przyszłości, przy okazji migracji, można podnieść wersję svajiraya/ldap-bundle.
