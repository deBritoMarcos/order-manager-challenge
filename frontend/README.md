# Frontend – Vite + React

O frontend utiliza Vite e React, com algumas dependências como Materialize CSS e React Router.

## Pré-requisitos

- [Node.js](https://nodejs.org/) (recomenda-se versão 18+)
- [npm](https://www.npmjs.com/) ou [yarn](https://yarnpkg.com/)

## Instalação

1. **Instale as dependências**

```bash
npm install
# ou
yarn
```

2. **Copie o arquivo de ambiente**

```bash
cp .env.example .env
```

3. **Execute o servidor de desenvolvimento**

```bash
npm run dev
# ou
yarn dev
```

O frontend estará disponível, por padrão, em: [http://localhost:5173](http://localhost:5173)

## Scripts disponíveis

- `dev`: Inicia o servidor de desenvolvimento
- `build`: Gera a build de produção
- `preview`: Visualiza a build de produção localmente
- `lint`: Executa o ESLint

## rotas

- Listagem das orders: página reponsável pela listagem das orders, disponível em: `\`.
- Detalhes da order: página responsável por apresentar os detalhes do pedido, disponível em: `\order\:id`.
- Página não encontrada: disponível em: `\404`.
- Página de cheats: página responsável por apresentar cheats de testes da aplicação, disponível em: `\cheats`.
