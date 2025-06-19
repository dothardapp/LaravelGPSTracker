# 🛰️ TrackerGPS - API del Servidor

Este repositorio contiene el código fuente del backend para el sistema **TrackerGPS**. Se trata de una API RESTful robusta y escalable construida con **Laravel**, diseñada para recibir, almacenar y gestionar datos de localización de múltiples dispositivos en tiempo real, como aplicaciones móviles Android y hardware de rastreo IoT.

## ✨ Características Principales

* **Gestión de Múltiples Entidades:** Soporte para múltiples usuarios, y múltiples dispositivos de rastreo por cada usuario.
* **Historial de Rutas Detallado:** Almacena un historial completo de localizaciones para cada dispositivo, incluyendo datos enriquecidos como velocidad, rumbo, altitud y precisión.
* **API RESTful Clara:** Endpoints bien definidos para la comunicación con diferentes tipos de clientes.
* **Registro Automático de Dispositivos:** La lógica `firstOrCreate` permite que un nuevo dispositivo se registre automáticamente en el sistema con su primer envío de datos.
* **Arquitectura Escalable:** Basada en el patrón Modelo-Vista-Controlador (MVC) de Laravel, con una clara separación de responsabilidades que facilita el mantenimiento y la expansión futura.

## 🛠️ Stack Tecnológico

* **PHP** (v8.1+)
* **Laravel** (v10.x+)
* **Base de Datos:** Compatible con MySQL / **MariaDB**
* **Gestor de Dependencias:** **Composer**

## 🔌 Documentación de la API

La API expone los siguientes endpoints. La URL base para todas las llamadas es `http://tu-dominio.com/api/`.

### Usuarios (`/users`)

#### `GET /users`
Devuelve una lista de todos los usuarios registrados en el sistema. Es utilizado por la app cliente para mostrar las opciones de configuración.

* **Respuesta Exitosa (200 OK)**
    ```json
    [
        {
            "id": 1,
            "name": "Victoria",
            "created_at": "2025-06-19T18:00:00.000000Z",
            "updated_at": "2025-06-19T18:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Julieta",
            "created_at": "2025-06-19T18:01:00.000000Z",
            "updated_at": "2025-06-19T18:01:00.000000Z"
        }
    ]
    ```

### Localizaciones (`/locations`)

#### `POST /locations`
Endpoint principal para la ingesta de datos. Recibe un punto de localización de un dispositivo y lo almacena en la base de datos. Si el `device_id` es nuevo, crea el dispositivo y lo asocia al `tracker_user_id` proporcionado.

* **Cuerpo de la Petición (Request Body)**

| Campo             | Tipo    | Obligatorio | Descripción                               |
| ----------------- | ------- | ----------- | ----------------------------------------- |
| `tracker_user_id` | number  | Sí          | El ID del usuario al que pertenece el dispositivo. |
| `device_id`       | string  | Sí          | El ID único del hardware (ej. UUID del teléfono). |
| `latitude`        | number  | Sí          | Latitud en grados decimales.              |
| `longitude`       | number  | Sí          | Longitud en grados decimales.             |
| `timestamp`       | string  | Sí          | Fecha y hora en formato ISO 8601.         |
| `speed`           | number  | No          | Velocidad en m/s.                         |
| `bearing`         | number  | No          | Rumbo en grados (0-360).                  |
| `altitude`        | number  | No          | Altitud en metros.                        |
| `accuracy`        | number  | No          | Precisión del punto en metros.            |

* **Respuesta Exitosa (201 Created)**
    ```json
    {
        "message": "Ubicación guardada con éxito",
        "location_id": 123
    }
    ```
* **Respuesta de Error (422 Unprocessable Entity)**
    ```json
    {
        "error": "Validación fallida",
        "details": {
            "latitude": [
                "The latitude field is required."
            ]
        }
    }
    ```

## 🚀 Instalación y Puesta en Marcha

Sigue estos pasos para instalar y ejecutar el proyecto en un entorno de desarrollo local.

1.  **Clonar el Repositorio**
    ```bash
    git clone [https://github.com/dothardapp/TrackerGPS.git](https://github.com/dothardapp/TrackerGPS.git)
    cd TrackerGPS
    ```

2.  **Instalar Dependencias**
    Asegúrate de tener Composer instalado.
    ```bash
    composer install
    ```

3.  **Configurar el Entorno**
    Crea tu archivo de entorno a partir del ejemplo.
    ```bash
    cp .env.example .env
    ```
    Luego, genera la clave de la aplicación.
    ```bash
    php artisan key:generate
    ```

4.  **Configurar la Base de Datos**
    Abre el archivo `.env` y configura las variables de tu base de datos (MariaDB/MySQL).
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gpstracker
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Ejecutar las Migraciones**
    Este comando creará todas las tablas en tu base de datos.
    ```bash
    php artisan migrate
    ```

6.  **Iniciar el Servidor**
    El servidor de desarrollo de Laravel se iniciará, por defecto, en `http://127.0.0.1:8000`.
    ```bash
    php artisan serve
    ```
    ¡Tu API ya está en funcionamiento y lista para recibir peticiones!

## 🔮 Futuras Mejoras (Roadmap)

- [ ] Implementar un sistema de autenticación (Laravel Sanctum) para proteger la API.
- [ ] Desarrollar un dashboard web para visualizar las rutas en un mapa en tiempo real.
- [ ] Añadir WebSockets para la actualización instantánea de la posición en el mapa web.
- [ ] Crear un servidor TCP/UDP para soportar una mayor variedad de dispositivos IoT de bajo nivel.
- [ ] Implementar políticas de archivado o eliminación de datos de localización antiguos.

---
*Este README fue generado con la ayuda de un asistente de IA.*