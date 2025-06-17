# Order Manager Challenge

Este projeto nasceu a partir do seguinte desafio:

```
Requirements
- An order has a control number and a state.
- When the order is added to the system, it has a pending state.
- I want to be able to start the progress of an order.
- I want to be able to complete an order.
- I want to filter orders by number control and state.

Invariants
- A pending order can only go to in progress state.
- An in progress order can only go to completed.
- Completed orders are done and should preserve its state.
```

## Sobre o projeto

Para esse desafio decidi implementar uma arquitetura moderna de aplicação web, separando as lógicas **backend** e **frontend** em projetos distintos.
Essa decisão foi tomada pensando em um cenário real, onde através dessa arquitetura é possível obter maior flexibilidade, escalabilidade, organização no desenvolvimento e manutenção da aplicação.
Apesar de estarem em um unico reposítório para fins de apresentação da aplicação como um todo, a separação foi feita simbolicamente por pastas, sendo cada pasta um projeto distinto.

## Mapa do Projeto

```plaintext
order-manager-challenge/
│
├── backend/   # API REST desenvolvida em Laravel 12 (PHP)
│   └── README.md
│
├── frontend/  # Aplicação web desenvolvida em Vite + React (Javascript)
│   └── README.md
│
└── README.md  # Este arquivo
```

### Backend

- **Framework:** Laravel 12, rodando em containers Docker com Laravel Sail.
- **Função:** Gerencia regras de negócio, persistência de dados e fornece endpoints REST para o frontend.
- **Como rodar:** Consulte `backend/README.md` para instruções de instalação, configuração e endpoints disponíveis.

### Frontend

- **Framework:** Vite + React.
- **Função:** Interface web para interação com o usuário, consumindo a API do backend.
- **Como rodar:** Consulte `frontend/README.md` para instruções de instalação, configuração e comandos de desenvolvimento.
