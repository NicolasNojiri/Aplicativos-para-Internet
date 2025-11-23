<?php
namespace generic;

class JWTManager {
    private static $secret = 'sua_chave_secreta_super_forte_2024!@#';
    
    public static function generateToken($userId, $email) {
        try {
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
            
            $payload = json_encode([
                'user_id' => $userId,
                'email' => $email,
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24)
            ]);
            
            $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
            
            $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, self::$secret, true);
            $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
            
            return $base64Header . "." . $base64Payload . "." . $base64Signature;
        } catch (Exception $e) {
            throw new \Exception('Erro ao gerar token: ' . $e->getMessage());
        }
    }
    
    public static function validateToken($token) {
        try {
            if (empty($token)) {
                throw new \Exception('Token não fornecido');
            }
            
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                throw new \Exception('Token inválido');
            }
            
            [$header, $payload, $signature] = $parts;
            
            $expectedSignature = hash_hmac('sha256', $header . "." . $payload, self::$secret, true);
            $expectedBase64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($expectedSignature));
            
            if ($signature !== $expectedBase64Signature) {
                throw new \Exception('Assinatura do token inválida');
            }
            
            $decodedPayload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $payload)), true);
            
            if (!$decodedPayload) {
                throw new \Exception('Payload do token inválido');
            }
            
            if (isset($decodedPayload['exp']) && $decodedPayload['exp'] < time()) {
                throw new \Exception('Token expirado');
            }
            
            return $decodedPayload;
        } catch (Exception $e) {
            throw new \Exception('Token inválido: ' . $e->getMessage());
        }
    }
    
    public static function getTokenFromHeader() {
        $headers = apache_request_headers();
        if (!$headers) {
            $headers = [];
            foreach ($_SERVER as $key => $value) {
                if (substr($key, 0, 5) == 'HTTP_') {
                    $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($key, 5))));
                    $headers[$header] = $value;
                }
            }
        }
        
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }
}
