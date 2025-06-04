<?php
require_once '../app/helpers/EnvHelper.php';

// Load biến môi trường
EnvHelper::loadEnv(__DIR__ . '/../../.env');

return [
    'client_id' => EnvHelper::getEnv('GOOGLE_CLIENT_ID'),
    'client_secret' => EnvHelper::getEnv('GOOGLE_CLIENT_SECRET'),
    'redirect_uri' => EnvHelper::getEnv('APP_URL') . '/public/authen/home/google_callback',
    'scopes' => ['openid', 'email', 'profile']
];