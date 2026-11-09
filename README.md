# Deberes

Aplicación web para **subir, organizar y descargar deberes de Computación y Matemática**. Está construida con **Laravel 13** y usa la plantilla **Minible** en su variante *Horizontal Boxed Width*.

## Características

- Panel principal con estadísticas y gráfico de deberes por materia.
- Subida de archivos con validación de tipo y tamaño (hasta 20 MB).
- Clasificación por materia: **Computación** y **Matemática**.
- Búsqueda por título, estudiante o descripción.
- Filtro por materia y paginación del listado.
- Vista de detalle con previsualización de imágenes, PDF y archivos de texto/código.
- Descarga de archivos con su nombre original.
- Eliminación de deberes con confirmación.
- Interfaz completamente en español.
- Datos de ejemplo incluidos mediante *seeder*.

## Tecnologías

- PHP 8.4
- Laravel 13
- SQLite
- Blade
- Bootstrap 5 + Minible (assets estáticos, sin Vite)
- ApexCharts

## Requisitos

- PHP 8.2 o superior con las extensiones habituales de Laravel (`pdo_sqlite`, `mbstring`, `fileinfo`, etc.).
- Composer.
- No se necesita Node.js: los assets de la plantilla ya están compilados en `public/assets`.

## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/paholaguevara2977-eng/deberes.git
cd deberes

# 2. Instalar dependencias de PHP
composer install

# 3. Crear el archivo de entorno
copy .env.example .env        # Windows
# cp .env.example .env        # Linux / macOS

# 4. Generar la clave de la aplicación
php artisan key:generate

# 5. Crear la base de datos SQLite si no existe
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

# 6. Ejecutar migraciones y datos de ejemplo
php artisan migrate --seed
```

> En Windows, si PHP no está en el `PATH`, usa la ruta completa al ejecutable `php.exe`.

## Ejecutar la aplicación

```bash
php artisan serve
```

Abre <http://127.0.0.1:8000> en el navegador.

## Formatos permitidos

| Tipo | Extensiones |
| --- | --- |
| Documentos | `pdf`, `doc`, `docx`, `xls`, `xlsx`, `ppt`, `pptx`, `txt` |
| Imágenes | `jpg`, `jpeg`, `png`, `gif`, `webp` |
| Comprimidos | `zip`, `rar` |

**Tamaño máximo:** 20 MB por archivo.

Los archivos se guardan en `storage/app/public/deberes` y se sirven a través de rutas del controlador, por lo que **no es necesario ejecutar `php artisan storage:link`**.

## Estructura relevante

```
app/Http/Controllers/DeberController.php   Lógica de listado, subida, descarga y borrado
app/Models/Deber.php                        Modelo y accesores (materia, tamaño, extensión)
database/migrations/..._create_deberes_table.php
database/seeders/DeberSeeder.php            Datos y archivos de ejemplo
resources/views/layouts/app.blade.php       Layout horizontal boxed de Minible
resources/views/dashboard.blade.php         Panel con estadísticas y gráfico
resources/views/deberes/                    Listado, formulario y detalle
public/assets/                              CSS, JS, fuentes e imágenes de Minible
```

## Pruebas

```bash
php artisan test
```

La suite cubre la subida de deberes, la validación de archivo y materia, y el filtrado por materia.

## Créditos

- Plantilla: [Minible – Admin & Dashboard Template](https://themesbrand.com/minible/) de Themesbrand.
- Framework: [Laravel](https://laravel.com).
