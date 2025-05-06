# Sistema de Gestión Departamental con Laravel y Moonshine

Sistema administrativo para la gestión de departamentos, empleados y proyectos desarrollado con Laravel y el panel administrativo Moonshine con un sistema completo de roles y permisos.

## Descripción

Este sistema permite administrar:
- **Departamentos**: Accounting, HR, IT y Production
- **Empleados**: Asignados a un único departamento
- **Proyectos**: Con título, fecha límite y presupuesto
- **Roles**: Definición de roles personalizados (Admin, Manager, Staff)
- **Permisos**: Asignación granular de permisos a roles

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
git clone https://github.com/tu-usuario/gestion-departamental.git
cd gestion-departamental
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
DB_DATABASE=gestion_departamental
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

Este comando creará las tablas necesarias y poblará la base de datos con:
- Roles predefinidos (Admin, Manager, Staff)
- Permisos básicos del sistema
- Departamentos de ejemplo
- Usuario administrador por defecto

### 6. Crear usuario administrador personalizado (opcional)

```bash
php artisan moonshine-rbac:user
```

Sigue las instrucciones en la terminal para crear tu usuario administrador con un rol específico.

### 7. Compilar assets

```bash
npm install
npm run dev
```

Si encuentras un error de PowerShell relacionado con la ejecución de scripts deshabilitada cuando ejecutas `npm install`, sigue estos pasos:

1. Abre PowerShell como Administrador (clic derecho en PowerShell y selecciona "Ejecutar como administrador")

2. Ejecuta uno de estos comandos para cambiar la política de ejecución:

   ```powershell
   Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy RemoteSigned
   ```

   O para una configuración más permisiva:

   ```powershell
   Set-ExecutionPolicy -Scope CurrentUser -ExecutionPolicy Unrestricted
   ```

3. Confirma el cambio escribiendo "Y" cuando se te solicite

4. Intenta ejecutar `npm install` nuevamente en el directorio de tu proyecto

### 8. Iniciar el servidor

```bash
php artisan serve
```

### 9. Acceder al panel de administración

Visita `http://localhost:8000/admin` en tu navegador y utiliza las credenciales del administrador.
- Email: admin@ejemplo.com
- Contraseña: password (cambiar inmediatamente después del primer inicio de sesión)

## Estructura del proyecto

```
├── app
│   ├── Models
│   │   ├── Department.php
│   │   ├── Employee.php
│   │   ├── Project.php
│   │   ├── Role.php
│   │   └── Permission.php
│   ├── MoonShine
│   │   ├── Resources
│   │   │   ├── DepartmentResource.php
│   │   │   ├── EmployeeResource.php
│   │   │   ├── ProjectResource.php
│   │   │   ├── RoleResource.php
│   │   │   └── PermissionResource.php
│   │   ├── Policies
│   │   │   ├── DepartmentPolicy.php
│   │   │   ├── EmployeePolicy.php
│   │   │   ├── ProjectPolicy.php
│   │   │   └── RolePolicy.php
│   │   └── Gates
│   │       └── CheckPermission.php
│   └── Services
│       └── PermissionService.php
├── database
│   ├── migrations
│   │   ├── xxxx_xx_xx_create_departments_table.php
│   │   ├── xxxx_xx_xx_create_employees_table.php
│   │   ├── xxxx_xx_xx_create_projects_table.php
│   │   ├── xxxx_xx_xx_create_roles_table.php
│   │   ├── xxxx_xx_xx_create_permissions_table.php
│   │   └── xxxx_xx_xx_create_role_permission_table.php
│   └── seeders
│       ├── DepartmentSeeder.php
│       ├── RoleSeeder.php
│       ├── PermissionSeeder.php
│       └── AdminUserSeeder.php
└── routes
    └── moonshine.php
```

## Sistema de roles y permisos

El sistema utiliza un enfoque basado en roles y permisos según el artículo [Permisos basados en roles para Moonshine](https://estivenm00.blogspot.com/2025/03/permisos-basados-en-roles-para.html).

### Roles predefinidos

- **Admin**: Acceso completo a todas las funcionalidades del sistema
- **Manager**: Puede administrar empleados y proyectos, pero no roles ni permisos
- **Staff**: Acceso de solo lectura a la mayoría de los módulos

### Permisos disponibles

Para cada recurso (Departamentos, Empleados, Proyectos):
- **view**: Permiso para ver registros
- **create**: Permiso para crear nuevos registros
- **update**: Permiso para editar registros existentes
- **delete**: Permiso para eliminar registros

### Configuración personalizada

Puedes crear nuevos roles y asignar permisos específicos según las necesidades de tu organización a través del panel de administración.

## Recuperación de contraseña

Si pierdes la contraseña del administrador, puedes restablecerla con alguno de estos métodos:

1. **Usar el comando de Moonshine RBAC**:
   ```bash
   php artisan moonshine-rbac:user
   ```
   Especifica el correo electrónico existente y establece una nueva contraseña.

2. **Mediante Tinker**:
   ```bash
   php artisan tinker
   >>> $user = \MoonShine\Models\MoonshineUser::where('email', 'admin@ejemplo.com')->first();
   >>> $user->password = bcrypt('nueva_contraseña');
   >>> $user->save();
   ```

## Personalización de permisos

Para añadir nuevos permisos o modificar la lógica de autorización:

1. Añade nuevos permisos en `database/seeders/PermissionSeeder.php`
2. Actualiza las políticas en `app/MoonShine/Policies/`
3. Registra los nuevos permisos en `app/Providers/MoonShineServiceProvider.php`

## Contribución

Si deseas contribuir a este proyecto, por favor:

1. Crea un fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/nueva-caracteristica`)
3. Haz commit de tus cambios (`git commit -m 'Añadir nueva característica'`)
4. Sube la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## Licencia

Este proyecto está licenciado bajo [MIT License](LICENSE).
