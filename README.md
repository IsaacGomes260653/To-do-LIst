# 📝 Gerenciador de Tarefas (To-Do List)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000f?style=for-the-badge&logo=mysql&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Status](https://img.shields.io/badge/Status-Concluído-brightgreen?style=for-the-badge)

> Um sistema web prático, seguro e elegante para organização de afazeres diários, focado em produtividade e usabilidade.

---

## 🎯 Sobre o Projeto

Este projeto nasceu da necessidade de criar uma ferramenta simples e eficiente para o gerenciamento de rotinas. Diferente de tabelas complexas de dados, este sistema foca em uma lista fluida de afazeres, permitindo que o usuário tenha controle total sobre o que precisa ser feito no seu dia a dia, tudo isso protegido por um sistema de autenticação.

---

## 🌟 Funcionalidades

O sistema conta com tudo o que é necessário para manter sua rotina em dia:

- 🔒 **Acesso Restrito**: Sistema de login seguro com controle de sessão (apenas usuários cadastrados podem ver e gerenciar suas tarefas).
- ⚡ **Gestão de Afazeres (CRUD)**:
  - **Adicionar**: Inserção rápida de novas tarefas.
  - **Visualizar**: Lista organizada dos afazeres pendentes.
  - **Editar**: Possibilidade de alterar a descrição ou detalhes de uma tarefa já criada.
  - **Excluir**: Remoção de tarefas concluídas ou canceladas com apenas um clique.
- 🎨 **Interface Focada no Usuário**: Design limpo e intuitivo, com feedbacks visuais e ícones para facilitar a navegação.

---

## 🛠️ Tecnologias Utilizadas

A aplicação foi construída utilizando as seguintes tecnologias:

- **Back-end:** PHP 8.x
- **Banco de Dados:** MySQL (utilizando PDO para prevenir SQL Injection)
- **Front-end:** HTML5 e CSS3 (Design responsivo e animações)
- **Ícones:** [FontAwesome 6.4](https://fontawesome.com/)
- **Servidor Local:** Apache (compatível com XAMPP, WAMP, etc.)

---

## 📂 Estrutura de Pastas e Arquivos

O projeto está organizado de forma modular para facilitar a manutenção:

```text
PROJETO_TAREFAS/
├── tarefas/            # Módulo principal da lista de afazeres
│   ├── index.php       # Interface principal da lista e formulário
│   ├── inserir.php     # Back-end: Adiciona ou atualiza uma tarefa
│   └── excluir.php     # Back-end: Remove uma tarefa do banco
├── index.php           # Tela inicial de Login
├── logar.php           # Validação de credenciais de acesso
├── conexao.php         # Script de conexão com o banco MySQL
├── sessao.php          # Bloqueio de páginas para usuários não logados
├── style.css           # Folha de estilos unificada
└── logout.php          # Encerramento seguro da sessão
