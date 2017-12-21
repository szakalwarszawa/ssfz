@echo off

echo *********************
echo composer install
echo *********************
call composer install
echo *********************
echo yarn install
echo *********************
call yarn --cwd src\Parp\SsfzBundle\Resources\public install
echo *********************
echo console assets:install
echo *********************
php app\console assets:install
echo *********************
echo console cache:clear
echo *********************
php app\console cache:clear
