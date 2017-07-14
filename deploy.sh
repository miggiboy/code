# load dependencies
/usr/local/php-cgi/7.1/bin/php composer.phar install

# link storage
unlink mustim09.beget.tech/public_html/public/storage
/usr/local/php-cgi/7.1/bin/php artisan storage:link

# cache config files
/usr/local/php-cgi/7.1/bin/php artisan config:cache

# cache route files
/usr/local/php-cgi/7.1/bin/php artisan route:cache

# make application live
/usr/local/php-cgi/7.1/bin/php artisan up
