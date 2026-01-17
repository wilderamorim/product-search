# 🛒 Sistema de Busca de Produtos com Laravel & Livewire

Este projeto é uma aplicação prática desenvolvida para demonstrar a implementação de um mecanismo de busca avançado e reativo. A solução utiliza o ecossistema moderno do Laravel para oferecer filtros combinados de nome, categorias e marcas, garantindo uma experiência de usuário fluida e performática.

## 🚀 Sobre o Projeto

O objetivo principal desta aplicação é servir como um guia de referência para a construção de interfaces dinâmicas sem a necessidade de escrever JavaScript complexo, aproveitando o poder do **Livewire**. O sistema utiliza o **PostgreSQL** como motor de banco de dados, garantindo robustez e suporte a consultas complexas.

### Tecnologias Utilizadas

A tabela abaixo detalha as principais tecnologias que compõem a stack deste projeto:

| Tecnologia | Versão | Finalidade |
| :--- | :--- | :--- |
| **Laravel** | 12 | Framework PHP principal e estrutura do projeto. |
| **Livewire** | 4 | Reatividade do front-end e gerenciamento de estado. |
| **PostgreSQL** | - | Banco de dados relacional para armazenamento de produtos. |
| **Tailwind CSS** | - | Estilização moderna e responsiva baseada em utilitários. |
| **Laravel Sail** | - | Ambiente de desenvolvimento isolado via Docker. |

---

## 🛠️ Guia de Instalação e Configuração

Siga os passos abaixo para configurar o ambiente de desenvolvimento em sua máquina local utilizando o Docker.

### 1. Clonagem e Preparação Inicial

Primeiro, clone o repositório e prepare o arquivo de variáveis de ambiente. O arquivo `.env` é fundamental para que o Laravel saiba como se conectar ao banco de dados e outros serviços.

```bash
# Clonar o repositório
git clone https://github.com/wilderamorim/product-search.git

# Entrar na pasta do projeto
cd product-search

# Criar o arquivo de ambiente
cp .env.example .env
```

### 2. Configuração do Banco de Dados

Certifique-se de que as seguintes variáveis no seu arquivo `.env` estejam configuradas para o PostgreSQL, conforme o padrão do Laravel Sail:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 3. Inicialização do Ambiente

Com o Docker instalado, execute os comandos abaixo para instalar as dependências e subir os containers.

```bash
# Instalar dependências do PHP via Composer
composer install

# Iniciar os containers do Docker (em segundo plano)
./vendor/bin/sail up -d

# Instalar e compilar os assets do front-end
./vendor/bin/sail npm install
./vendor/bin/sail npm run build

# Gerar a chave única da aplicação
./vendor/bin/sail artisan key:generate
```

---

## 📊 Populando o Banco de Dados

Para que você possa testar a busca imediatamente, o projeto inclui **Migrations** (que criam as tabelas) e **Seeders** (que inserem dados fictícios de categorias, marcas e produtos).

```bash
./vendor/bin/sail artisan migrate --seed
```

> **Nota:** Após este comando, o sistema estará pronto para uso com uma base de dados populada.

---

## 🧪 Testes Automatizados

A qualidade do código é garantida através de testes automatizados utilizando o **Pest**, uma ferramenta de testes focada em simplicidade e legibilidade.

```bash
./vendor/bin/sail pest
```

---

## 💡 Detalhes de Implementação

Esta aplicação foi desenhada com foco em usabilidade e boas práticas de desenvolvimento:

*   **Persistência de Filtros:** Os filtros aplicados na busca (nome, categoria, marca) são sincronizados automaticamente com a URL via *query string*. Isso permite que o usuário atualize a página ou compartilhe o link sem perder o estado da busca.
*   **Reatividade:** Graças ao Livewire, a lista de produtos é atualizada em tempo real conforme o usuário interage com os filtros, sem a necessidade de recarregar a página inteira.
*   **Ambiente Isolado:** O uso do Laravel Sail garante que todos os desenvolvedores trabalhem exatamente com as mesmas versões de PHP, Node e PostgreSQL, evitando o famoso problema do "na minha máquina funciona".

---
*Desenvolvido como um projeto de teste prático para demonstração de competências técnicas.*
