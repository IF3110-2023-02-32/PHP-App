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
define('VIDEO_TYPE', 'video');
define('MAX_VIDEO_SIZE', 50 * MEGABYTE);
// Audios
define('AUDIO_TYPE', 'audio');
define('MAX_AUDIO_SIZE', 20 * MEGABYTE);
// Images
define('IMAGE_TYPE', 'image');
define('MAX_IMAGE_SIZE', 20 * MEGABYTE);

define('MAX_FILE_SIZE', [
    VIDEO_TYPE => MAX_VIDEO_SIZE,
    AUDIO_TYPE => MAX_AUDIO_SIZE,
    IMAGE_TYPE => MAX_IMAGE_SIZE
]);

define('SUPPORTED_FILES', [
    VIDEO_TYPE => [
        'video/mp4' => '.mp4'
    ],
    AUDIO_TYPE => [
        'audio/mpeg' => '.mp3'
    ],
    IMAGE_TYPE => [
        'image/jpeg' => '.jpeg',
        'image/png' => '.png'
    ]
]);

/* -- Session Configuration -- */
define('COOKIES_LIFETIME', 24 * 60 * 60);
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REGENERATION_TIME', 30 * 60);

/* -- App Configuration -- */
define('DEBOUNCE_TIMEOUT', 500);
define('ROWS_PER_PAGE', 10); // For pagination
