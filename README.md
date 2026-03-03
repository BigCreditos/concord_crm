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

## 🐳 Como rodar com Docker/Portainer

Esta aplicação está configurada para rodar via **Portainer Stacks** ou Docker Compose.

### 1. Configuração do Portainer (Stack)

Copie o conteúdo do arquivo `docker-compose.yml` e cole no campo "Web editor" ao criar uma nova Stack no Portainer.

### 2. Variáveis de Ambiente Necessárias

Certifique-se de configurar as seguintes variáveis no seu arquivo `.env` ou no painel do Portainer:

| Variável | Descrição | Valor Padrão |
| :--- | :--- | :--- |
| `DB_CONNECTION` | Driver do banco | `mysql` |
| `DB_HOST` | Host do banco | `db` |
| `DB_PORT` | Porta do banco | `3306` |
| `DB_DATABASE` | Nome do banco | `concord` |
| `DB_USERNAME` | Usuário do banco | `concord` |
| `DB_PASSWORD` | Senha do banco | `concord` |
| `REDIS_HOST` | Host do Redis | `redis` |

### 3. Comandos Úteis

**Subir a stack localmente:**
```bash
docker compose up -d
```

**Ver logs:**
```bash
docker compose logs -f
```

**Rodar comandos Artisan:**
```bash
docker exec -it concord-app php artisan key:generate
```

O serviço `automator` rodará automaticamente as migrations assim que o banco de dados estiver pronto.

## 🤝 Contribution

Contributions are welcome! Please feel free to submit Pull Requests or open issues for bugs and feature requests.

## 📄 License

Concord CRM is a proprietary software. Please check the `LICENSE` file (if available) for more details.

---
*Built with ❤️ for better sales management.*
