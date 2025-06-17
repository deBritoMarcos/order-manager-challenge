# Backend – Laravel 12 + Sail

Este backend utiliza Laravel 12, rodando em containers Docker com Laravel Sail.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started) e [Docker Compose](https://docs.docker.com/compose/)

## Instalação

1. **Copie o arquivo de ambiente**

```bash
cp .env.example .env
```

2. **Suba os containers com Sail**

Se já tiver o Composer instalado localmente, você pode instalar as dependências e rodar o Sail:

```bash
composer install
./vendor/bin/sail up -d
```

Se não tiver o Composer, use o Sail diretamente:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install

./vendor/bin/sail up -d
```

4. **Gere a chave da aplicação**

```bash
./vendor/bin/sail artisan key:generate
```

5. **Execute as migrations**

```bash
./vendor/bin/sail artisan migrate
```

## Acesso

Execute o comando para deixar o servidor disponível:

```bash
./vendor/bin/sail artisan serve
```

- A API estará disponível em: [http://localhost:3000](http://localhost:3000) (ou porta configurada no `docker-compose.yml`)

## Comandos úteis

- Parar containers: `./vendor/bin/sail down`
- Rodar os testes: `./vendor/bin/sail test`

## Rotas

### Webhook

- **POST /api/webhook/order**  
  Recebe notificações externas para criação de pedidos.  
  
  **Payload exemplo:**
  ```json
  {
    "state": "create",
    "orderCode": 123456,
  }
  ```

### Pedidos

- **GET /api/orders**  
  Lista todos os pedidos.

- **GET /api/orders?code=123456&status=pending**  
  Lista os pedidos com base nos parametros code e status, ambos são opcionais.

- **GET /api/orders/{id}**  
  Detalha um pedido específico pelo seu ID.

- **PUT /api/orders/{id}/situation**  
  Atualiza a situação (status) de um pedido.