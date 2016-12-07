# StyleSensei

App provider:

Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class
_______________________________________________________________________

Commands to use after installing laravel-filemanager (composer update):

php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
php artisan vendor:publish --tag=lfm_view

===================
config in: lmf.php
===================
'middlewares'           => ['web', 'auth:consultant']
'allow_multi_user'      => false,

'images_dir'            => 'public/uploads/articles/photos/',
'images_url'            => '/uploads/articles/photos/',

'files_dir'             => 'public/uploads/articles/files/',
'files_url'             => '/uploads/articles/files/',

====================
create directories:
====================
public/uploads/articles/files/
public/uploads/articles/photos/

set permissions to access these folders for www-data

Thank you,
Stanislav