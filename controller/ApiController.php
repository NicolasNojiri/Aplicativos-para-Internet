<?php
namespace controller;

use generic\JWTManager;

class ApiController {
    
    public function handleRequest() {
        try {
            session_start();
            
            $method = $_SERVER['REQUEST_METHOD'];
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $pathParts = explode('/', trim($path, '/'));
            
            $apiIndex = array_search('api.php', $pathParts);
            if ($apiIndex !== false) {
                $pathParts = array_slice($pathParts, $apiIndex + 1);
            }
            
            if (empty($pathParts) && isset($_SERVER['PATH_INFO'])) {
                $pathParts = explode('/', trim($_SERVER['PATH_INFO'], '/'));
            }

            $resource = $pathParts[0] ?? '';
            $id = $pathParts[1] ?? null;
            
            if ($resource === 'auth' && $method === 'POST') {
                $this->handleAuth();
                return;
            }
            
            if ($resource === 'register' && $method === 'POST') {
                $this->handleRegister();
                return;
            }
            
            $this->validateAuthentication();
            
            switch ($resource) {
                case 'produtos':
                    $this->handleProdutos($method, $id);
                    break;
                case 'usuarios':
                    $this->handleUsuarios($method, $id);
                    break;
                case 'feedback':
                    $this->handleFeedback($method, $id);
                    break;
                default:
                    $this->sendError('Recurso não encontrado', 404);
            }
        } catch (Exception $e) {
            $this->sendError('Erro interno: ' . $e->getMessage(), 500);
        }
    }
    
    private function validateAuthentication() {
        try {
            $token = JWTManager::getTokenFromHeader();
            if (!$token) {
                $this->sendError('Acesso não autorizado', 401);
                return;
            }
            
            $payload = JWTManager::validateToken($token);
            
            $_SESSION['user_id'] = $payload['user_id'];
            $_SESSION['user_email'] = $payload['email'];
        } catch (Exception $e) {
            $this->sendError('Acesso não autorizado', 401);
        }
    }
    
    private function handleAuth() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($input['email']) || !isset($input['password'])) {
                $this->sendError('Email e senha são obrigatórios', 400);
                return;
            }
            
            $authController = new AuthController();
            $authController->login($input['email'], $input['password']);
        } catch (Exception $e) {
            $this->sendError('Erro na autenticação: ' . $e->getMessage(), 500);
        }
    }
    
    private function handleRegister() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($input['nome']) || !isset($input['email']) || !isset($input['password'])) {
                $this->sendError('Nome, email e senha são obrigatórios', 400);
                return;
            }
            
            $authController = new AuthController();
            $authController->register($input['nome'], $input['email'], $input['password']);
        } catch (Exception $e) {
            $this->sendError('Erro no registro: ' . $e->getMessage(), 500);
        }
    }
    
    private function handleProdutos($method, $id) {
        try {
            $controller = new ProdutoApiController();
            
            switch ($method) {
                case 'GET':
                    if ($id) {
                        $controller->show($id);
                    } else {
                        $controller->index();
                    }
                    break;
                case 'POST':
                    $controller->store();
                    break;
                case 'PUT':
                    if (!$id) {
                        $this->sendError('ID do produto é obrigatório para atualização', 400);
                        return;
                    }
                    $controller->update($id);
                    break;
                case 'DELETE':
                    if (!$id) {
                        $this->sendError('ID do produto é obrigatório para exclusão', 400);
                        return;
                    }
                    $controller->destroy($id);
                    break;
                default:
                    $this->sendError('Método não permitido', 405);
            }
        } catch (Exception $e) {
            $this->sendError('Erro ao processar produtos: ' . $e->getMessage(), 500);
        }
    }
    
    private function handleUsuarios($method, $id) {
        try {
            $controller = new UsuarioApiController();
            
            switch ($method) {
                case 'GET':
                    if ($id) {
                        $controller->show($id);
                    } else {
                        $controller->index();
                    }
                    break;
                case 'POST':
                    $controller->store();
                    break;
                case 'PUT':
                    if (!$id) {
                        $this->sendError('ID do usuário é obrigatório para atualização', 400);
                        return;
                    }
                    $controller->update($id);
                    break;
                case 'DELETE':
                    if (!$id) {
                        $this->sendError('ID do usuário é obrigatório para exclusão', 400);
                        return;
                    }
                    $controller->destroy($id);
                    break;
                default:
                    $this->sendError('Método não permitido', 405);
            }
        } catch (Exception $e) {
            $this->sendError('Erro ao processar usuários: ' . $e->getMessage(), 500);
        }
    }
    
    private function handleFeedback($method, $id) {
        try {
            $controller = new FeedbackApiController();
            
            switch ($method) {
                case 'GET':
                    if ($id) {
                        $controller->show($id);
                    } else {
                        $controller->index();
                    }
                    break;
                case 'POST':
                    $controller->store();
                    break;
                case 'PUT':
                    if (!$id) {
                        $this->sendError('ID do feedback é obrigatório para atualização', 400);
                        return;
                    }
                    $controller->update($id);
                    break;
                case 'DELETE':
                    if (!$id) {
                        $this->sendError('ID do feedback é obrigatório para exclusão', 400);
                        return;
                    }
                    $controller->destroy($id);
                    break;
                default:
                    $this->sendError('Método não permitido', 405);
            }
        } catch (Exception $e) {
            $this->sendError('Erro ao processar feedback: ' . $e->getMessage(), 500);
        }
    }
    
    private function sendError($message, $code = 400) {
        http_response_code($code);
        echo json_encode([
            'error' => $message,
            'code' => $code
        ]);
        exit;
    }
}
