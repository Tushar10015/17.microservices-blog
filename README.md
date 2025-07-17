# Laravel Microservices Blog Platform 📰

This is a microservices-based blog platform built using Laravel, Docker, and Vue Livewire.

## 📦 Microservices Structure

- `api-gateway/` - Gateway to route requests to all services
- `auth-service/` - Handles user registration, login, JWT
- `post-service/` - Manages blog posts
- `comment-service/` - Handles comments
- `notification-service/` - Sends real-time notifications

## 🚀 Getting Started

### Prerequisites

- Docker & Docker Compose
- PHP (optional, for local development)
- Composer

### Running the Services

```bash
docker compose up --build
