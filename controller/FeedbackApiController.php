<?php
namespace controller;

use service\FeedbackService;

class FeedbackApiController {
    private $service;
    
    public function __construct() {
        $this->service = new FeedbackService();
    }
    
    public function index() {
        try {
            $feedbacks = $this->service->listar();
            $this->sendResponse([
                'message' => 'Feedbacks listados com sucesso',
                'data' => $feedbacks
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao listar feedbacks: ' . $e->getMessage());
        }
    }
    
    public function show($id) {
        try {
            $feedback = $this->service->listarId($id);
            if (!$feedback || empty($feedback)) {
                $this->sendError('Feedback não encontrado', 404);
                return;
            }
            
            $this->sendResponse([
                'message' => 'Feedback encontrado com sucesso',
                'data' => $feedback[0]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao buscar feedback: ' . $e->getMessage());
        }
    }
    
    public function store() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->sendError('Dados inválidos. Esperado JSON válido', 400);
                return;
            }
            
            $produto_id = $input['produto_id'] ?? null;
            $usuario_id = $input['usuario_id'] ?? null;
            $nota = $input['nota'] ?? 0;
            $comentario = $input['comentario'] ?? '';
            
            $id = $this->service->inserir($produto_id, $usuario_id, $nota, $comentario);
            
            $this->sendResponse([
                'message' => 'Feedback criado com sucesso',
                'data' => [
                    'id' => $id,
                    'produto_id' => $produto_id,
                    'usuario_id' => $usuario_id,
                    'nota' => $nota,
                    'comentario' => $comentario
                ]
            ], 201);
        } catch (\Exception $e) {
            $this->sendError('Erro ao criar feedback: ' . $e->getMessage());
        }
    }
    
    public function update($id) {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $this->sendError('Dados inválidos. Esperado JSON válido', 400);
                return;
            }
            
            $nota = $input['nota'] ?? 0;
            $comentario = $input['comentario'] ?? '';
            
            $this->service->atualizar($id, $nota, $comentario);
            
            $this->sendResponse([
                'message' => 'Feedback atualizado com sucesso',
                'data' => [
                    'id' => $id,
                    'nota' => $nota,
                    'comentario' => $comentario
                ]
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao atualizar feedback: ' . $e->getMessage());
        }
    }
    
    public function destroy($id) {
        try {
            $this->service->excluir($id);
            
            $this->sendResponse([
                'message' => 'Feedback excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            $this->sendError('Erro ao excluir feedback: ' . $e->getMessage());
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
