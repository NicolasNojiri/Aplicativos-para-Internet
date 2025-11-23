<?php
namespace controller;

use service\UserService;
use generic\JWTManager;

class AuthController {
    
    public function login($email, $password) {
        try {
            if (empty($email) || empty($password)) {
                $this->sendResponse(['error' => 'Email e senha são obrigatórios'], 400);
                return;
            }
            
            $userService = new UserService();
            $user = $userService->authenticate($email, $password);
            
            if (!$user) {
                $this->sendResponse(['error' => 'Credenciais inválidas'], 401);
                return;
            }
            
            $token = JWTManager::generateToken($user['id'], $user['email']);
            
            $this->sendResponse([
                'message' => 'Login realizado com sucesso',
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'nome' => $user['nome'],
                    'email' => $user['email']
                ]
            ]);
            
        } catch (Exception $e) {
            error_log("Auth Error: " . $e->getMessage());
            $this->sendResponse(['error' => 'Erro no processo de autenticação'], 500);
        }
    }
    
    public function register($nome, $email, $password) {
        try {
            if (empty($nome) || empty($email) || empty($password)) {
                $this->sendResponse(['error' => 'Nome, email e senha são obrigatórios'], 400);
                return;
            }
            
            $userService = new UserService();
            $userId = $userService->inserir($nome, $email, $password);
            
            $user = $userService->listarId($userId);
            
            $this->sendResponse([
                'message' => 'Usuário registrado com sucesso.',
                'user_id' => $userId
            ], 201);
            
        } catch (Exception $e) {
            error_log("Register Error: " . $e->getMessage());
            $this->sendResponse(['error' => 'Erro no processo de registro: ' . $e->getMessage()], 400);
        }
    }
    
    public function validateToken() {
        try {
            $token = JWTManager::getTokenFromHeader();
            
            if (!$token) {
                $this->sendResponse(['error' => 'Token não fornecido'], 401);
                return false;
            }
            
            $payload = JWTManager::validateToken($token);
            
            $this->sendResponse([
                'message' => 'Token válido',
                'user' => [
                    'id' => $payload['user_id'],
                    'email' => $payload['email']
                ]
            ]);
            
            return $payload;
            
        } catch (Exception $e) {
            $this->sendResponse(['error' => 'Token inválido'], 401);
            return false;
        }
    }
    
    private function sendResponse($data, $httpCode = 200) {
        http_response_code($httpCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
