
<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
  <a href="https://laravel.com" target="_blank">
    <img src="https://mintcdn.com/filament-34a8cf01/08pxkrBLnmtNM7ng/logo/dark.svg?fit=max&auto=format&n=08pxkrBLnmtNM7ng&q=85&s=0e2f592992019b62c6bd2231f4fad26f" width="400" alt="Laravel Logo">
  </a>
</p>

**Laravel 12 + Filament 4**

Plataforma de comercio electrónico desarrollada con arquitectura moderna, enfocada en escalabilidad, seguridad y gestión administrativa avanzada.

---

##  Características Principales

*  Autenticación y autorización basada en roles
*  Gestión de usuarios y permisos
*  Emisión y control de facturación
*  Administración de productos
*  Gestión de clientes
*  Registro y control de ventas
*  Reportes administrativos y financieros
*  Seguridad y control de acceso granular
*  Panel administrativo profesional con Filament 4
*  Compatible con MySQL y PostgreSQL
*  Entorno de desarrollo con Docker

---

##  Stack Tecnológico

* **Backend:** Laravel 12
* **Panel Administrativo:** Filament 4
* **Base de Datos:** MySQL / PostgreSQL
* **Contenedores:** Docker
* **Gestión de Dependencias:** Composer

---

#  Instalación del Proyecto

## 1️ Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

---

## 2️ Instalar dependencias

```bash
composer install
```

---

## 3️ Configuración del entorno

Renombrar el archivo:

```bash
.env.example → .env
```

Luego generar la clave de la aplicación:

```bash
php artisan key:generate
```

---

## 4️ Configurar base de datos

Levantar contenedores (si usas Docker):

```bash
docker compose up -d
```

Configurar las variables de base de datos en el archivo `.env`.

Ejemplo MySQL:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=secret
```

Ejemplo PostgreSQL:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ecommerce
DB_USERNAME=postgres
DB_PASSWORD=secret
```

---

## 5️ Ejecutar migraciones

```bash
php artisan migrate
```

---

## 6️ Crear usuario administrador (Filament 4)

```bash
php artisan make:filament-user
```

Esto permitirá acceder al panel administrativo en:

```
/admin
```

---

## 7️ Iniciar servidor de desarrollo

```bash
php artisan serve
```

Aplicación disponible en:

```
http://localhost:8000
```

---

#  Seguridad

* Protección CSRF integrada
* Sistema de permisos basado en roles
* Control de acceso por políticas
* Validaciones robustas en backend

---

#  Panel Administrativo

El sistema incluye un dashboard moderno desarrollado con Filament 4, permitiendo:

* Gestión centralizada
* Visualización de métricas
* Control completo del negocio
* Administración segura y eficiente

---

#  Requisitos

* PHP 8.2+
* Composer
* Docker (opcional pero recomendado)
* MySQL 8+ o PostgreSQL 14+

---

#  Enfoque Empresarial

Este proyecto está diseñado bajo buenas prácticas de desarrollo, con una estructura organizada, preparada para:

* Escalabilidad
* Implementación en producción
* Integración futura con APIs externas
* Adaptación a entornos corporativos

