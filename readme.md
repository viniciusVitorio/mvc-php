# PHP-MVC
o Projeto consiste em um mini sistema MVC em PHP com CRUD de **Pessoas** e **Contatos**, utilizando **Doctrine ORM** e **PostgreSQL**, rodando em **Docker**.

## 🚀 Tecnologias

- **PHP**
- **Nginx**
- **PostgreSQL 16**
- **Doctrine ORM**
- **Composer**
- **Docker / Docker Compose**

## ⚙️ Configuração do ambiente

1. Clone o repositório:
   ```bash
   git clone https://github.com/viniciusVitorio/mvc-php.git
   cd mvc-php
   ```
   
2. Crie o .env
   ```bash
   cp .env.example .env
   ```

3. Suba os containers:
    ```bash
    docker compose -f infra/compose.yaml up -d --build
    ```

4. Instale as dependências PHP
   ```bash
   docker compose -f infra/compose.yaml exec php composer install
   ```

5. Configure o banco de dados
   ```bash
   docker compose -f infra/compose.yaml exec php php util/createSchema.php
   ```

### Desenvolvido por Vinicius Vitório Rodrigues.