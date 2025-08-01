# 🍱 Sistema de Pedidos – Korean Food (PHP + JWT + WhatsApp)

Este proyecto es una aplicación web desarrollada en PHP para un restaurante coreano. Permite a los usuarios visualizar productos, agregarlos a un carrito y enviar su pedido por WhatsApp. También incluye un panel administrativo con autenticación mediante JWT y control de accesos según roles.

---

## 🚀 Funcionalidades Principales

### 👥 Usuario Cliente

- Visualización de productos clasificados por categorías (Dosirak, Ramyeon, Rice, Guarniciones, Bebidas).
- Agregado de productos al carrito.
- Visualización del total del pedido en tiempo real.
- Envío del pedido mediante WhatsApp Web.
- Validación de sesión (no se puede enviar pedido sin estar logueado).
- Recepción de correo electrónico (vía PHPMailer) con confirmación.

### 🛠️ Usuario Administrador

- Login con validación mediante JWT.
- Gestión de roles: acceso diferenciado como administrador o usuario común.
- Registro de nuevos productos.
- Edición y actualización de productos existentes.
- Eliminación de productos del catálogo.
- Administración completa del menú desde el panel administrativo.

---

## 🔐 Seguridad y Validaciones

- Autenticación segura con JSON Web Tokens (JWT).
- Protección de rutas sensibles (como agregar, editar o eliminar productos).
- Verificación de rol para evitar accesos no autorizados.
- Bloqueo de envío de pedidos sin login.
- Envío de correos con PHPMailer para recuperación o confirmación.

---

## ⚙️ Tecnologías Utilizadas

- **Backend**: PHP 8+
- **Base de Datos**: MySQL (relacional, con integridad referencial entre productos y categorías)
- **Autenticación**: JWT (Firebase PHP-JWT)
- **Correo Electrónico**: PHPMailer
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript
- **Notificaciones**: Alertify.js
- **Mensajería**: Enlace automático con WhatsApp Web
- **Configuración Segura**: Variables almacenadas en archivo `.env` mediante `cargar_env.php` personalizado

---

## 📌 Consideraciones Finales

Este sistema está diseñado para ser ligero, funcional e ideal para restaurantes que deseen tomar pedidos en línea de forma rápida y segura, integrando WhatsApp, correo electrónico y un panel de administración completo.
