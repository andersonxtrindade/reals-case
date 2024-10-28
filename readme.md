# Real Case Project

Este é um projeto dividido em duas partes: o backend e o frontend. Abaixo estão as descrições e instruções para cada parte do projeto.

## Backend

### Tecnologias Utilizadas
- **Laravel 11**: Um framework PHP para desenvolvimento de aplicações web.
- **SQLite**: Um banco de dados leve e portátil.

### Configuração do Backend

1. Navegue até a pasta do backend:
    ```bash
    cd reals-case/backend
    ```

2. Instale as dependências do Laravel:
    ```bash
    composer install
    ```

3. Configure o ambiente:
    - Renomeie o arquivo `.env.example` para `.env` e ajuste as configurações de banco de dados conforme necessário.
    - O banco de dados SQLite é configurado por padrão, certifique-se de que o arquivo `database.sqlite` esteja presente no diretório `database`.

4. Execute as migrações:
    ```bash
    php artisan migrate
    ```

5. Inicie o servidor embutido do Laravel:
    ```bash
    php artisan serve
    ```

O backend estará disponível em `http://127.0.0.1:8000/api`.

## Frontend

### Tecnologias Utilizadas
- **Vue.js**: Um framework progressivo para construir interfaces de usuário.
- **Pinia**: Um gerenciador de estado para Vue.js.
- **Tailwind CSS**: Uma framework CSS utilitário para estilização.

### Configuração do Frontend

1. Navegue até a pasta do frontend:
    ```bash
    cd reals-case-frontend
    ```

2. Instale as dependências do Vue.js:
    ```bash
    npm install
    ```

3. Inicie o servidor de desenvolvimento:
    ```bash
    npm run dev
    ```

O frontend estará disponível em `http://localhost:5173`.
