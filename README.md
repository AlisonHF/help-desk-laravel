# 🎫 Help Desk

Sistema de chamados de suporte técnico — abertura, acompanhamento e permissões por papel.

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![daisyUI](https://img.shields.io/badge/daisyUI-5-1AD1A5)
![Vite](https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white)

## Sobre

Aplicação de abertura e gestão de chamados construída para aprender **Laravel na prática**. Trabalho profissionalmente com CodeIgniter 3, e este projeto é onde exploro o jeito Laravel de resolver os mesmos problemas do dia a dia: autenticação, autorização, ORM e organização de views. O escopo é enxuto de propósito — a ideia é fazer cada parte do jeito idiomático do framework, não empilhar features.

## Destaques técnicos

- Autenticação com **Laravel Fortify** (registro, login e logout) e telas próprias em Blade
- Autorização com **Gates** (`ticket-update`, `ticket-delete`, `is-technician`) aplicadas na rota via middleware `can:` e nas views via `@can`
- **Enums nativos do PHP** (`TicketStatus`, `UserPositions`) com `label()` e cor de badge centralizados no próprio enum — a view nunca decide texto ou cor de status
- Cast automático de enum no model e atributos **`#[Fillable]`** do Laravel 13 no lugar do array `$fillable`
- Listagem filtrada por papel: admin vê tudo, técnico vê os chamados vinculados a ele, usuário só os próprios
- Duas relações para a mesma tabela no `Ticket` — `user()` (solicitante) e `technician()` (atendente) — com FK explícita
- Validação server-side com feedback por flash message e componente de **toast**
- **Log de auditoria** em toda mutação: quem criou, atualizou ou excluiu cada chamado
- Layout responsivo com drawer (daisyUI) e componentes Blade reutilizáveis (cards, toast, breadcrumb)

## Funcionalidades

| Módulo | Recursos |
|---|---|
| Auth | Registro, login e logout via Fortify; novo usuário já nasce com papel "usuário" |
| Chamados | Abertura com categoria, listagem por papel, edição e exclusão com permissão, status com badge |
| Permissões | Três papéis (admin, técnico, usuário) controlados por Gates |
| UI | Home com atalhos, breadcrumbs, toasts de sucesso/erro, listagem em tabela e cards responsivos |

## Papéis e permissões

| Papel | Visualiza | Edita | Exclui |
|---|---|---|---|
| **Admin** | Todos os chamados | Qualquer chamado | Qualquer chamado |
| **Técnico** | Em aberto + vinculados a ele | Vinculados a ele | — |
| **Usuário** | Somente os próprios | Os próprios, enquanto em aberto | — |

## Stack

**Backend:** Laravel 13 (PHP 8.3), Fortify
**Frontend:** Blade, Tailwind CSS 4, daisyUI 5, Alpine.js, Heroicons
**Build e qualidade:** Vite 8, Pest, Pint
**Banco:** MySQL (SQLite por padrão no `.env.example`)

## Rodando o projeto

Pré-requisitos: PHP 8.3+, Composer e Node 20+.

```bash
git clone https://github.com/AlisonHF/help-desk-laravel.git help-desk
cd help-desk

# Instala dependências, cria o .env, gera a key, migra e builda os assets
composer run setup

# Sobe servidor, fila e Vite de uma vez
composer run dev
```

Pronto. Acesse: http://localhost:8000

O `.env.example` usa **SQLite**, então funciona sem configurar nada. Para usar MySQL, ajuste as variáveis `DB_*` no `.env` antes de rodar as migrations.

> Com **Laravel Herd**, a aplicação também responde em `http://help-desk.test` — nesse caso basta rodar `npm run dev` para os assets.

## Estrutura

```
app/
├── Actions/Fortify/    → customizações de cadastro e senha
├── Enums/              → TicketStatus e UserPositions (label e cor num lugar só)
├── Http/Controllers/   → Auth, Home e Ticket
├── Models/             → User, Ticket e Category
└── Providers/          → Gates de autorização + configuração do Fortify
resources/views/
├── Layouts/            → master com drawer e navbar
├── components/         → card-auth, card-home, toast
├── partials/           → cabeçalho de página com breadcrumb
├── auth/               → login e registro
└── ticket/             → listagem e formulário
```

## Próximos passos

- [ ] Atribuição de técnico ao chamado
- [ ] Transição de status (em andamento → finalizado) com registro de `completed_in`
- [ ] Gestão de categorias
- [ ] Testes de feature com Pest

---

Feito por [Alison Faria](https://alisonfaria.com.br) ⚡
