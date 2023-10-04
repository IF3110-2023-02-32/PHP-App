<?php

/* -- CONSTANTS -- */
define('MEGABYTE', 1048576); // 1024 * 1024
define('MINUTE', 60);
define('HOUR', 3600);

/* -- Database Configuration -- */
define('DBNAME', $_ENV['POSTGRES_DB']);
define('DBUSER', $_ENV['POSTGRES_USER'] ?? 'postgres');
define('DBPASSWORD', $_ENV['POSTGRES_PASSWORD']);
define('DBHOST', $_ENV['POSTGRES_HOST']);
define('DBPORT', $_ENV['POSTGRES_PORT']);

define('CONNECT_RETRIES', 4);

/* -- Static File Configuration -- */
// Videos
define('MAX_VIDEO_SIZE', 100 * MEGABYTE);
define('ALLOWED_VIDEOS', [
    'video/mp4' => '.mp4'
]);
// Audios
define('MAX_AUDIO_SIZE', 100 * MEGABYTE);
define('ALLOWED_AUDIOS', [
    'audio/mpeg' => '.mp3'
]);
// Images
define('MAX_IMAGE_SIZE', 100 * MEGABYTE);
define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
]);

/* -- Session Configuration -- */
define('COOKIES_LIFETIME', 24 * 60 * 60);
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REGENERATION_TIME', 30 * 60);

/* -- App Configuration -- */
define('DEBOUNCE_TIMEOUT', 500);
define('ROWS_PER_PAGE', 10); // For pagination
