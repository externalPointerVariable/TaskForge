# 🛠️ TaskForge

### A Modular Full-Stack Web Application for Task Management

Welcome to TaskForge! This project is a modular, full-stack web application designed to manage employees and their assigned tasks with a focus on **clarity, scalability, and maintainability**. Built with real-world development practices, it provides a robust and clean foundation for a modern web platform.

### ✨ Core Features

#### 🏗️ Modular Backend Architecture

The application is built with **PHP** and leverages **Composer** for PSR-4 autoloading, a clean controller separation, and scalable routing.

#### 🗃️ SQLite Database Integration

TaskForge utilizes a **SQLite database** with a defined schema for `user`, `user_profile`, and `tasks` tables. **Foreign key constraints** and **cascading deletes** ensure data integrity.

#### ⚙️ Environment Configuration

Sensitive information, such as database credentials, is managed securely via a `.env` file, which is excluded from version control for enhanced security.

#### 📈 Dynamic Dashboard

The dashboard features **dynamic sidebar navigation** and a **responsive card layout**. It allows managers to view and manage employee tasks, while employees can view their assigned tasks and update their status.

### 🚀 Architectural Highlights

* **PSR-4 Autoloading**: For organized and efficient class loading.

* **PDO-based Abstraction**: Provides a secure and modern approach to database operations.

* **Dotenv Integration**: Enables robust environment management.

* **Tailwind CSS**: Used for a clean, modern, and fully responsive user interface.

* **Apache Routing**: Configured for clean URLs and seamless CLI compatibility for testing and deployment.