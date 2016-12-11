# StyleSensei
_______________________________________________________________________
Commands to run:

composer update

php artisan vendor:publish --tag=lfm_public
php artisan vendor:publish --tag=lfm_view

====================
create directories:
====================
public/uploads/articles/files/
public/uploads/articles/photos/

================================================
set permissions to access these folders as root:
================================================
chown user:www-data -R articles/
chmod 777 -R articles/

Thank you,
Stanislav