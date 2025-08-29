# Backend – Laravel 12 + Sail

Este backend utiliza Laravel 12, rodando em containers Docker com Laravel Sail.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started) e [Docker Compose](https://docs.docker.com/compose/)

## Instalação

- **Copie o arquivo de ambiente**

```bash
cp .env.example .env
```

- **Instale as dependencias do projeto**

Se não tiver o Composer instalado em seu computador, use o seguinte comando:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/app \
    -w /app \
    composer install
```

Se já tiver o Composer instalado localmente, rode o comando:

```bash
composer install
```

- **Crie os containers e levante a aplicação**

```bash
./vendor/bin/sail up -d
```

- **Gere a chave da aplicação**

```bash
./vendor/bin/sail artisan key:generate
```

- **Execute as migrations**

```bash
./vendor/bin/sail artisan migrate
```

- **Popule o banco de dados**

```bash
./vendor/bin/sail artisan db:seed
```

## Acesso

Execute o comando para deixar o servidor disponível:

```bash
./vendor/bin/sail artisan serve
```

- A API estará disponível em: [http://localhost:80](http://localhost:80) (ou a porta configurada no `docker-compose.yml`)

## Comandos úteis

- Parar containers: `./vendor/bin/sail down`
- Rodar os testes: `./vendor/bin/sail test`