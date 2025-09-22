# Sistema de Feedback

Sistema web desenvolvido em PHP para gerenciamento de feedback de produtos, utilizando arquitetura MVC.

## 🚀 Funcionalidades

- **Gestão de Produtos**: Cadastro, listagem e edição de produtos
- **Gestão de Usuários**: Cadastro e listagem de usuários
- **Sistema de Feedback**: Avaliação de produtos com notas de 0 a 5 e comentários
- **Interface Responsiva**: Design moderno e responsivo

## 🛠️ Tecnologias Utilizadas

- PHP 7.4+
- MySQL 5.7+
- HTML5, CSS3
- Arquitetura MVC
- PDO para acesso ao banco de dados

## 📋 Pré-requisitos

- Servidor web com PHP (Apache/Nginx)
- MySQL
- Extensões PHP: PDO, PDO_MySQL

## 🔧 Instalação

1. **Clone ou baixe o projeto**
   ```bash
   git clone [URL_DO_REPOSITORIO]
   ```

2. **Configure o banco de dados**
   - Importe o arquivo `database.sql` no seu MySQL
   - Ou execute o script SQL diretamente

3. **Configure a aplicação**
   - Edite o arquivo `config.php` com suas configurações de banco de dados

4. **Configure o servidor web**
   - Aponte o document root para a pasta do projeto
   - Certifique-se de que o módulo de reescrita está habilitado

## 🗄️ Estrutura do Banco de Dados

### Tabelas:
- **produtos**: id, nome, descricao, created_at, updated_at
- **usuarios**: id, nome, email, created_at, updated_at  
- **feedback**: id, produto_id, usuario_id, nota, comentario, created_at, updated_at

## 📁 Estrutura do Projeto

```
├── controller/          # Controladores MVC
├── dao/                # Data Access Objects
├── service/            # Camada de serviços
├── generic/            # Classes genéricas (Autoload, MVC)
├── template/           # Templates de layout
├── public/             # Views (HTML/PHP)
├── config.php          # Configurações do sistema
├── database.sql        # Script de criação do banco
└── index.php          # Ponto de entrada da aplicação
```

## 🌐 Como Usar

1. **Acesse a aplicação** pelo navegador
2. **Cadastre produtos** na seção correspondente
3. **Cadastre usuários** para poder avaliar
4. **Envie feedbacks** selecionando produto, usuário, nota e comentário
5. **Visualize os feedbacks** na listagem com códigos de cores por nota

## 🔗 Rotas da Aplicação

- `index.php` - Página inicial
- `?param=produto/lista` - Listar produtos
- `?param=produto/formulario` - Cadastrar produto
- `?param=usuario/lista` - Listar usuários
- `?param=usuario/formulario` - Cadastrar usuário
- `?param=feedback/lista` - Listar feedbacks
- `?param=feedback/formulario` - Enviar feedback

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.