# Meu Campeonato

Aplicação web para simulação de campeonatos esportivos.

## Introdução

Este guia oferece instruções detalhadas sobre como configurar e executar o projeto "Meu Campeonato" em sua máquina local para desenvolvimento e testes.

### Pré-requisitos

Antes de iniciar, certifique-se de ter as seguintes ferramentas instaladas em seu sistema:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

### Instalação e Execução

A aplicação pode ser acessada localmente após a instalação através da URL: [Localhost Frontend](http://localhost:8080/)

Siga os passos abaixo para configurar o ambiente de desenvolvimento:

1. **Clonar o Repositório**

   Faça o clone do repositório do projeto para sua máquina local:

   ```bash
   git clone https://github.com/webthiagosilva/mychampionship.git

2. **Crie os container**
	
	No diretório raiz do projeto (/mychampionship), execute o Docker Compose para construir e iniciar os containers:
	```bash
	docker compose up --build -d
3. **Instalação das Dependências**

	Entre no container do backend para instalar as dependências. Navegue até o diretório mychampionship/backend e utilize o Makefile:
	```bash
	cd mychampionship/backend
	make bash
	composer install
4. **Configuração do Banco de Dados**

	Ainda dentro do container do backend, execute as migrações e o seeding do banco de dados:
	```bash
	php artisan migrate
	php artisan db:seed



### Testando a aplicação
Para executar os testes, use o comando 'make test' dentro do container do backend

**Acessando a Aplicação**
Após a configuração, a aplicação frontend estará disponível em http://localhost:8080/.
