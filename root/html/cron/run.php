#!/usr/local/bin/php71 -f /usr/home/ae159j6q55/html/cron/run.php
<?php
exec( '/usr/local/bin/php-7.0 /usr/home/ae159j6q55/laravel/artisan schedule:run >> /usr/home/ae159j6q55/html/mylogs/cron_log 2>&1');
exit;
?>