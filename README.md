# 🚗 Sistema de Concesionario de Automóviles

Sistema web para la gestión de vehículos en un concesionario, desarrollado con **Laravel 12**, **Tailwind CSS**, **Alpine.js** y **Vite**. Permite registrar, visualizar, editar y eliminar automóviles con autenticación de usuarios integrada.

---

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Configuración de Base de Datos](#-configuración-de-base-de-datos)
- [Credenciales de Prueba](#-credenciales-de-prueba)
- [Uso](#-uso)
- [Tests](#-tests)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)

---

## ✨ Características

- ✅ Autenticación completa (registro, login, recuperación de contraseña) con **Laravel Breeze**
- ✅ CRUD completo de automóviles (crear, listar, ver, editar, eliminar)
- ✅ Búsqueda y filtrado por marca o nombre de modelo
- ✅ Carga de imágenes para cada vehículo
- ✅ Paginación de resultados
- ✅ Validación de formularios (lado servidor)
- ✅ Panel de administración
- ✅ Diseño responsivo con Tailwind CSS

---

## 🖥️ Requisitos del Sistema

Asegúrate de tener instalado lo siguiente antes de comenzar:

| Herramienta | Versión mínima |
|-------------|----------------|
| PHP         | 8.2 o superior |
| Composer    | 2.x            |
| Node.js     | 18.x o superior|
| npm         | 9.x o superior |
| MySQL       | 5.7 o superior |
| Git         | Cualquier versión reciente |

> **Recomendado para Windows**: Usar [WAMP](https://www.wampserver.com/) o [Laragon](https://laragon.org/).

---

## ⚙️ Instalación

Sigue estos pasos en orden para configurar el proyecto localmente:

### 1. Clonar el repositorio

```bash
git clone https://github.com/CarlosMorillo0010/Sistema-de-Concesionario-de-Autom-viles.git
cd Sistema-de-Concesionario-de-Autom-viles
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Copiar el archivo de entorno

```bash
cp .env.example .env
```

> En Windows (PowerShell):
> ```powershell
> copy .env.example .env
> ```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Instalar dependencias de Node.js

```bash
npm install
```

### 6. Compilar los assets (CSS y JS)

```bash
npm run build
```

> Para desarrollo con recarga automática usa:
> ```bash
> npm run dev
> ```

---

## 🗄️ Configuración de Base de Datos

### 1. Crear la base de datos

Crea una base de datos MySQL vacía desde tu gestor (phpMyAdmin, MySQL Workbench, etc.):

```sql
CREATE DATABASE concesionario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Configurar el archivo `.env`

Abre el archivo `.env` y actualiza las credenciales de tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=concesionario
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Ejecutar las migraciones

Crea todas las tablas en la base de datos:

```bash
php artisan migrate
```

### 4. Poblar la base de datos con datos de prueba

```bash
php artisan db:seed
```

Esto crea:
- Un usuario administrador de prueba
- Registros de autos de ejemplo

### 5. Crear el enlace de almacenamiento (imágenes)

```bash
php artisan storage:link
```

---

## 🔑 Credenciales de Prueba

Después de ejecutar el seeder, puedes iniciar sesión con:

| Campo      | Valor               |
|------------|---------------------|
| Email      | `admin@test.com`    |
| Contraseña | `123456789`         |

---

## ▶️ Uso

### Iniciar el servidor de desarrollo

```bash
php artisan serve
```

Luego abre tu navegador en: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

> Si usas WAMP, el proyecto estará disponible en: **http://localhost/concesionario/public**

### Rutas principales

| Ruta              | Descripción                         |
|-------------------|-------------------------------------|
| `/`               | Página principal / listado de autos |
| `/cars`           | Catálogo de vehículos               |
| `/cars/create`    | Registrar nuevo vehículo            |
| `/cars/{id}`      | Ver detalle de un vehículo          |
| `/cars/{id}/edit` | Editar vehículo                     |
| `/login`          | Iniciar sesión                      |
| `/register`       | Crear nueva cuenta                  |
| `/dashboard`      | Panel de administración             |

---

## 🧪 Tests

El proyecto usa **PestPHP** como framework de testing.

### Ejecutar todos los tests

```bash
php artisan test
```

O alternativamente:

```bash
./vendor/bin/pest
```

### Ejecutar solo tests de autenticación

```bash
php artisan test --filter=Auth
```

### Ejecutar solo tests de perfil

```bash
php artisan test --filter=ProfileTest
```

### Ver output detallado

```bash
php artisan test --verbose
```

### Tests incluidos

| Archivo de Test                              | Descripción                                      |
|----------------------------------------------|--------------------------------------------------|
| `tests/Feature/Auth/AuthenticationTest.php`  | Login, logout y acceso autenticado               |
| `tests/Feature/Auth/RegistrationTest.php`    | Registro de nuevos usuarios                      |
| `tests/Feature/Auth/PasswordResetTest.php`   | Recuperación de contraseña                       |
| `tests/Feature/Auth/PasswordUpdateTest.php`  | Actualización de contraseña                      |
| `tests/Feature/Auth/EmailVerificationTest.php` | Verificación de correo electrónico             |
| `tests/Feature/Auth/PasswordConfirmationTest.php` | Confirmación de contraseña                  |
| `tests/Feature/ProfileTest.php`              | Ver, editar y eliminar perfil de usuario         |

> **Nota**: Los tests usan la base de datos de testing. Se recomienda configurar `DB_CONNECTION=sqlite` en el archivo `phpunit.xml` o usar una base de datos separada para no afectar los datos de desarrollo.

---

## 📁 Estructura del Proyecto

```
concesionario/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CarController.php        # CRUD de vehículos
│   │   │   └── Auth/                    # Controladores de autenticación
│   │   ├── Requests/
│   │   │   ├── StoreCarRequest.php      # Validación al crear auto
│   │   │   └── UpdateCarRequest.php     # Validación al editar auto
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Car.php                      # Modelo de Vehículo
│   │   └── User.php                     # Modelo de Usuario
├── database/
│   ├── migrations/                      # Estructura de tablas
│   ├── seeders/
│   │   ├── DatabaseSeeder.php           # Seeder principal
│   │   └── CarSeeder.php                # Datos de autos de ejemplo
│   └── factories/
│       └── CarFactory.php               # Factory para generar autos
├── resources/
│   └── views/
│       ├── cars/                        # Vistas CRUD de autos
│       ├── auth/                        # Vistas de autenticación
│       ├── admin/                       # Panel de administración
│       └── layouts/                     # Layouts base
├── routes/
│   ├── web.php                          # Rutas web principales
│   └── auth.php                         # Rutas de autenticación
└── tests/
    └── Feature/                         # Tests de funcionalidad
```

---

## 🛠️ Tecnologías Utilizadas

| Tecnología      | Versión  | Uso                              |
|-----------------|----------|----------------------------------|
| Laravel         | ^12.0    | Framework PHP principal          |
| Laravel Breeze  | ^2.4     | Autenticación                    |
| Tailwind CSS    | ^3.1     | Estilos y diseño responsivo      |
| Alpine.js       | ^3.4     | Interactividad en el frontend    |
| Vite            | ^7.0     | Compilación de assets            |
| PestPHP         | ^3.8     | Framework de testing             |
| MySQL           | 5.7+     | Base de datos                    |

---

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor abre un **Issue** para reportar un bug o sugerir una nueva característica, y un **Pull Request** para contribuir con código.

---

## 📄 Licencia

Este proyecto está bajo la licencia **MIT**. Consulta el archivo [LICENSE](LICENSE) para más detalles.
