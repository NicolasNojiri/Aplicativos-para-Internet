<?php
namespace controller;

use service\ProductService;

class ProdutoApiController {
    private $service;
    
    public function __construct() {
        $this->service = new ProductService();
    }
    
    public function index() {
        try {
            $produtos = $this->service->listar();
            $this->sendResponse([
                'message' => 'Produtos listados com sucesso',
                'data' => $produtos
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao listar produtos: ' . $e->getMessage());
        }
    }
    
    public function show($id) {
        try {
            $produto = $this->service->listarId($id);
            if (!$produto || empty($produto)) {
                $this->sendError('Produto não encontrado', 404);
                return;
            }
            
            $this->sendResponse([
                'message' => 'Produto encontrado com sucesso',
                'data' => $produto[0]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao buscar produto: ' . $e->getMessage());
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
            $descricao = $input['descricao'] ?? '';
            
            $id = $this->service->inserir($nome, $descricao);
            
            $this->sendResponse([
                'message' => 'Produto criado com sucesso',
                'data' => [
                    'id' => $id,
                    'nome' => $nome,
                    'descricao' => $descricao
                ]
            ], 201);
        } catch (\Exception $e) {
            $this->sendError('Erro ao criar produto: ' . $e->getMessage());
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
            $descricao = $input['descricao'] ?? '';
            
            $this->service->alterar($id, $nome, $descricao);
            
            $this->sendResponse([
                'message' => 'Produto atualizado com sucesso',
                'data' => [
                    'id' => $id,
                    'nome' => $nome,
                    'descricao' => $descricao
                ]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao atualizar produto: ' . $e->getMessage());
        }
    }
    
    public function destroy($id) {
        try {
            $this->service->excluir($id);
            
            $this->sendResponse([
                'message' => 'Produto excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao excluir produto: ' . $e->getMessage());
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
