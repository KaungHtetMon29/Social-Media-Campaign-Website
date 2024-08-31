<?php
class JWTManager
{
    private $secret = "khm";
    public function __construct()
    {
    }
    private function base64UrlEncode($text)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
    }
    private function base64UrlDecode($text)
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $text);
        $base64Padded = str_pad($base64, strlen($base64) % 4, '=', STR_PAD_RIGHT);
        return base64_decode($base64Padded);
    }
    public function createToken($payload)
    {
        $base64UrlHeader = $this->base64UrlEncode(json_encode(['typ' => 'JWT', 'alg' => 'HS256']));
        $base64Payload = $this->base64UrlEncode(json_encode($payload));
        $base64Signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64Payload, $this->secret);
        return $base64UrlHeader . "." . $base64Payload . "." . $base64Signature;
    }
    public function verifyToken($token)
    {
        list($header, $payload, $signature) = explode('.', $token);
        $base64Signature = hash_hmac('sha256', $header . "." . $payload, $this->secret);
        return hash_equals($base64Signature, $signature);
    }
    public function decodeToken($token)
    {
        list(, $payload, ) = explode('.', $token);
        return json_decode($this->base64UrlDecode($payload));
    }
}