php bin/console cache:clear
php bin/console d:m:m --no-interaction 
php bin/console doctrine:fixtures:load --append
exec apache2-foreground