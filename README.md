# Concord CRM

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Vite](https://img.shields.io/badge/Vite-5.0-646CFF?style=for-the-badge&logo=vite)](https://vitejs.dev/)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com/)

Concord CRM is a modern, self-hosted deals management CRM designed for speed, flexibility, and ease of use. Built on top of the powerful Laravel 11 framework, it offers a robust solution for tracking deals, managing contacts, and automating your sales process.

## 🚀 Key Features

- **Pipeline Management**: Easily track your deals through customizable stages and pipelines.
- **Contact & Company Management**: Keep all your business relationships organized in one place.
- **Activity Tracking**: Manage tasks, calls, and meetings with integrated activity management.
- **Mail Integration**: Seamlessly connect with Gmail and Outlook (Microsoft Graph) to manage your inbox directly from the CRM.
- **Modular Architecture**: Built with a modular approach, making it easy to extend and maintain.
- **Real-time Updates**: Powered by Pusher (or local alternatives) for instant UI reactivity.
- **Customizable Dashboard**: Get a high-level overview of your sales performance.
- **Document Management**: Create and track documents and proposals.

## 🛠 Technology Stack

- **Backend**: [Laravel 11](https://laravel.com/)
- **Frontend**: [Vue.js](https://vuejs.org/), [Tailwind CSS](https://tailwindcss.com/), [Vite](https://vitejs.dev/)
- **Modules**: [Laravel Modules](https://nwidart.com/laravel-modules/)
- **Integrations**: 
    - Google API (Calendar, Gmail)
    - Microsoft Graph (Office 365)
    - AWS S3
    - Pusher (WebSockets)
    - Twilio (SMS/Calls)

## 📦 Installation

This is a standard Laravel application. To set it up locally:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/BigCreditos/concord_crm.git
   cd concord_crm
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Don't forget to configure your database settings in the `.env` file.*

4. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate --seed
   ```

5. **Build Assets**:
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

6. **Serve the Application**:
   ```bash
   php artisan serve
   ```

## 🐳 Como Rodar a Stack no Portainer

Como Engenheiro DevOps, configurei esta aplicação para ser implantada de forma resiliente e automatizada.

### 1. Implantação via Portainer (Web Editor ou Git)

Você tem duas opções principais no Portainer:

#### Opção A: Git Repository (Recomendado para CI/CD)
1. No Portainer, vá em **Stacks** -> **Add stack**.
2. Selecione **Repository**.
3. Em **Repository URL**, cole: `https://github.com/BigCreditos/concord_crm.git`.
4. Em **Compose path**, mantenha `docker-compose.yml`.
5. Clique em **Deploy the stack**.

#### Opção B: Web Editor
1. Copie o conteúdo do arquivo `docker-compose.yml` deste repositório.
2. No Portainer, vá em **Stacks** -> **Add stack**.
3. Cole o conteúdo no campo **Web editor**.

### 2. Variáveis de Ambiente Cruciais

Para que a stack suba corretamente, você **DEVE** definir as seguintes variáveis na seção **Environment variables** do Portainer:

| Variável | Descrição | Exemplo/Ação |
| :--- | :--- | :--- |
| `APP_URL` | URL completa do sistema (Dinâmico) | `https://seu-dominio.com` |
| `APP_KEY` | Chave de criptografia do Laravel | Gere via `php artisan key:generate` |
| `DB_DATABASE` | Nome do banco de dados | `concord` |
| `DB_USERNAME` | Usuário do MySQL | `concord` |
| `DB_PASSWORD` | Senha do banco (Root e Usuário) | `sua_senha_segura` |
| `MYSQL_ROOT_PASSWORD` | Senha root do MySQL | `sua_senha_segura` |

> [!IMPORTANT]
> A stack utiliza um serviço de `automator` que aguarda o banco de dados estar pronto (Healthcheck) e executa `php artisan migrate --force` automaticamente.

### 3. Operações Pós-Instalação

Se precisar rodar comandos manuais (como gerar a APP_KEY se esqueceu):
```bash
docker exec -it concord-app php artisan key:generate --show
```

## 🤝 Contribution

Contributions are welcome! Please feel free to submit Pull Requests or open issues for bugs and feature requests.

## 📄 License

Concord CRM is a proprietary software. Please check the `LICENSE` file (if available) for more details.

---
*Built with ❤️ for better sales management.*
