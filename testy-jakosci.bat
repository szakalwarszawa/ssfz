@ECHO OFF
echo *********************
echo phpmetrics
echo *********************
call bin\phpmetrics src\
echo *********************
echo phpmd
echo *********************
call bin\phpmd src\ text cleancode,controversial --suffixes php src
echo *********************
echo phpcs
echo *********************
call bin\phpcs -n --colors --report=full --standard=vendor/leaphub/phpcs-symfony2-standard/leaphub/phpcs/Symfony2/ --extensions=php src\