<?php

namespace App\Services;

class YandexCapchaService
{
    public function __construct(private string $serverKey,private string $token)
    {

    }
    public function check_captcha(): bool
    {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => $this->serverKey,
            "token" => $this->token,
            "ip" => $_SERVER['REMOTE_ADDR'], // Нужно передать IP пользователя.
            // Как правильно получить IP зависит от вашего прокси.
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return true;
        }
        $resp = json_decode($server_output);
        return $resp->status === "ok";
    }
}