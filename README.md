# Sistema de Gestión Departamental con Laravel y Moonshine

Sistema administrativo para la gestión de departamentos, empleados y proyectos desarrollado con Laravel y el panel administrativo Moonshine.

## Descripción

Este sistema permite administrar:
- **Departamentos**: Accounting, HR, IT y Production
- **Empleados**: Asignados a un único departamento
- **Proyectos**: Con título, fecha límite y presupuesto

## Requisitos previos

- PHP 8.1 o superior
- Composer
- MySQL o PostgreSQL
- Node.js y npm (para compilar assets)
- Git

## Pasos para instalar el proyecto

Sigue estos pasos para instalar y ejecutar el proyecto en tu entorno local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/nombre-del-repositorio.git
cd nombre-del-repositorio
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos

Edita el archivo `.env` con tus credenciales de base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar migraciones

```bash
php artisan migrate
```

### 6. Crear usuario administrador

```bash
php artisan moonshine:user
```

Sigue las instrucciones en la terminal para crear tu usuario administrador.

### 7. Compilar assets (si es necesario)

```bash
npm install
npm run dev
```

### 8. Iniciar el servidor

```bash
php artisan serve
```

### 9. Acceder al panel de administración

Visita `http://localhost:8000/admin` en tu navegador y utiliza las credenciales que creaste en el paso 6.

## Estructura del proyecto

```
├── app
│   ├── Models
│   │   ├── Department.php
│   │   ├── Employee.php
│   │   └── Project.php
│   └── MoonShine
│       ├── Resources
│       │   ├── DepartmentResource.php
│       │   ├── EmployeeResource.php
│       │   └── ProjectResource.php
│       └── ...
├── database
│   └── migrations
│       ├── xxxx_xx_xx_create_departments_table.php
│       ├── xxxx_xx_xx_create_employees_table.php
│       └── xxxx_xx_xx_create_projects_table.php
└── ...
```

## Recuperación de contraseña

Si pierdes la contraseña del administrador, puedes restablecerla con alguno de estos métodos:

1. **Usar el comando de Moonshine**:
   ```bash
   php artisan moonshine:user
   ```
   Especifica el correo electrónico existente y establece una nueva contraseña.

2. **Mediante Tinker**:
   ```bash
   php artisan tinker
   >>> $user = \MoonShine\Models\MoonshineUser::where('email', 'admin@ejemplo.com')->first();
   >>> $user->password = bcrypt('nueva_contraseña');
   >>> $user->save();
   ```

## Contribución

Si deseas contribuir a este proyecto, por favor:
1. Crea un fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Haz commit de tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Sube la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## Licencia

Este proyecto está licenciado bajo [MIT License](LICENSE).