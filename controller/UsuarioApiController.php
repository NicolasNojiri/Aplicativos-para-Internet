<?php
namespace controller;

use service\UserService;

class UsuarioApiController {
    private $service;
    
    public function __construct() {
        $this->service = new UserService();
    }
    
    public function index() {
        try {
            $usuarios = $this->service->listar();
            $this->sendResponse([
                'message' => 'Usuários listados com sucesso',
                'data' => $usuarios
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao listar usuários: ' . $e->getMessage());
        }
    }
    
    public function show($id) {
        try {
            $usuario = $this->service->listarId($id);
            if (!$usuario || empty($usuario)) {
                $this->sendError('Usuário não encontrado', 404);
                return;
            }
            
            $this->sendResponse([
                'message' => 'Usuário encontrado com sucesso',
                'data' => $usuario[0]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao buscar usuário: ' . $e->getMessage());
        }
    }
    
    public function store() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->sendError('Dados inválidos. Esperado JSON válido', 400);
                return;
            }
            
            $nome = $input['nome'] ?? '';
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? null;
            
            $id = $this->service->inserir($nome, $email, $password);
            
            $this->sendResponse([
                'message' => 'Usuário criado com sucesso',
                'data' => [
                    'id' => $id,
                    'nome' => $nome,
                    'email' => $email
                ]
            ], 201);
        } catch (\Exception $e) {
            $this->sendError('Erro ao criar usuário: ' . $e->getMessage());
        }
    }
    
    public function update($id) {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->sendError('Dados inválidos. Esperado JSON válido', 400);
                return;
            }
            
            $nome = $input['nome'] ?? '';
            $email = $input['email'] ?? '';
            $password = $input['password'] ?? null;
            
            $this->service->atualizar($id, $nome, $email, $password);
            
            $this->sendResponse([
                'message' => 'Usuário atualizado com sucesso',
                'data' => [
                    'id' => $id,
                    'nome' => $nome,
                    'email' => $email
                ]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }
    
    public function destroy($id) {
        try {
            $this->service->excluir($id);
            
            $this->sendResponse([
                'message' => 'Usuário excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao excluir usuário: ' . $e->getMessage());
        }
    }
    
    private function sendResponse($data, $httpCode = 200) {
        http_response_code($httpCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    private function sendError($message, $httpCode = 400) {
        http_response_code($httpCode);
        echo json_encode([
            'error' => $message
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
