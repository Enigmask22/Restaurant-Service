<?php

class GoogleOAuthHelper
{
    private $config;

    public function __construct()
    {
        $this->config = require_once __DIR__ . '/../config/google_config.php';
    }

    /**
     * Tạo URL authorization để redirect đến Google
     */
    public function getAuthUrl()
    {
        $params = [
            'client_id' => $this->config['client_id'],
            'redirect_uri' => $this->config['redirect_uri'],
            'scope' => implode(' ', $this->config['scopes']),
            'response_type' => 'code',
            'access_type' => 'offline',
            'prompt' => 'select_account consent',
            'state' => bin2hex(random_bytes(32)) // CSRF protection
        ];

        $_SESSION['oauth_state'] = $params['state'];

        return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
    }

    /**
     * Xử lý callback từ Google và lấy thông tin user
     */
    public function handleCallback($code, $state = null)
    {
        // Validate state để chống CSRF
        if (!isset($_SESSION['oauth_state']) || $state !== $_SESSION['oauth_state']) {
            throw new Exception('Invalid state parameter');
        }

        unset($_SESSION['oauth_state']);

        // Exchange authorization code for access token
        $tokenData = $this->getAccessToken($code);

        if (!$tokenData || !isset($tokenData['access_token'])) {
            throw new Exception('Failed to get access token');
        }

        // Get user info from Google API
        $userInfo = $this->getUserInfo($tokenData['access_token']);

        return $userInfo;
    }

    /**
     * Exchange authorization code for access token
     */
    private function getAccessToken($code)
    {
        $url = 'https://oauth2.googleapis.com/token';

        $postData = [
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'redirect_uri' => $this->config['redirect_uri'],
            'grant_type' => 'authorization_code',
            'code' => $code
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception('Failed to get access token. HTTP Code: ' . $httpCode);
        }

        return json_decode($response, true);
    }

    /**
     * Lấy thông tin user từ Google API
     */
    private function getUserInfo($accessToken)
    {
        $url = 'https://www.googleapis.com/oauth2/v2/userinfo?access_token=' . $accessToken;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception('Failed to get user info. HTTP Code: ' . $httpCode);
        }

        $userInfo = json_decode($response, true);

        // Validate required fields
        if (!isset($userInfo['id']) || !isset($userInfo['email'])) {
            throw new Exception('Invalid user info received from Google');
        }

        return $userInfo;
    }
}