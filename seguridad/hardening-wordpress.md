# Hardening de WordPress para EcoHogar

Checklist de seguridad para aplicar en el servidor de Abraham **antes** del lanzamiento y mantener después. Ordenada por prioridad: lo primero es lo que más protege con menos esfuerzo.

> Este documento es el plan; la ejecución paso a paso para un usuario no técnico está en `checklists/instalacion-hosting.md`.

---

## 1. Actualizaciones

- [ ] Activar **actualizaciones automáticas** del núcleo de WordPress (versiones menores; valorar también las mayores una vez el sitio esté estable).
- [ ] Activar auto-updates en **todos los plugins** y en el **theme** (salvo el theme custom ecohogar, que se actualiza manualmente desde el repo).
- [ ] Revisar semanalmente el panel: núcleo, plugins y temas sin actualizar son la principal puerta de entrada de ataques.
- [ ] Eliminar temas y plugins **inactivos**: lo que no se usa, se borra (menos superficie de ataque).
- [ ] Antes de actualizar el theme custom, hacer backup (ver punto 4).

## 2. Usuarios, contraseñas y 2FA

- [ ] Borrar o renombrar el usuario `admin` si existe; usar un nombre de usuario no predecible.
- [ ] Cada persona, una cuenta; nadie comparte credenciales.
- [ ] Roles mínimos: solo una cuenta con rol **Administrador**; redactores con rol **Editor** o **Autor**.
- [ ] Contraseñas de 16+ caracteres, únicas, generadas por un gestor de contraseñas.
- [ ] Activar **autenticación en dos pasos (2FA)** en todas las cuentas de administrador (plugin: Wordfence Login Security, Google Authenticator o similar — ver política de plugins).
- [ ] Limitar intentos de login (el plugin de seguridad lo hace) y cambiar la URL de login si se desea (`/wp-admin` es el primer sitio que prueban los bots).
- [ ] Desactivar el registro abierto de usuarios (`Ajustes → Generales`: "Cualquiera puede registrarse" **desmarcado**), salvo que el sitio lo necesite.

## 3. `wp-config.php` — snippets recomendados

Añadir **antes** de la línea `/* That's all, stop editing! */`:

```php
// Desactiva el editor de archivos del panel (evita que un atacante con acceso al admin modifique código)
define( 'DISALLOW_FILE_EDIT', true );

// Limita las revisiones de entradas (menos peso en la base de datos)
define( 'WP_POST_REVISIONS', 5 );

// Vacía la papelera cada 7 días
define( 'EMPTY_TRASH_DAYS', 7 );

// Fuerza SSL en el admin y en el login
define( 'FORCE_SSL_ADMIN', true );

// Desactiva la edición/instalación de plugins desde el panel si se gestiona por SFTP
// define( 'DISALLOW_FILE_MODS', true ); // solo si instalas todo por SFTP
```

Además:

- [ ] Generar **salts únicos** en https://api.wordpress.org/secret-key/1.1/salt/ y pegarlos en `wp-config.php` (cada instalación, los suyos; nunca reutilizar los de un tutorial).
- [ ] Mover `wp-config.php` **un nivel por encima** de la raíz pública si el hosting lo permite.
- [ ] `wp-config.php` nunca se sube a Git ni se comparte; contiene las claves de la base de datos.

## 4. Backups 3-2-1

**Regla 3-2-1:** 3 copias de los datos, en 2 soportes distintos, 1 de ellas fuera del servidor.

- [ ] **Qué:** base de datos completa + carpeta `wp-content` (themes, plugins, uploads) + `wp-config.php` (guardado aparte, cifrado).
- [ ] **Cada cuánto:** base de datos **diaria**, archivos **semanal** (o diario si se publican muchas imágenes).
- [ ] **Dónde:** 1) copia automática del hosting (si la ofrece); 2) plugin de backup (UpdraftPlus o similar) enviando a un almacenamiento externo (Google Drive, Dropbox, S3); 3) descarga manual mensual a tu computadora.
- [ ] **Probar la restauración:** una vez al trimestre, restaurar el backup en un subdominio de pruebas o en local y comprobar que el sitio funciona. Un backup no probado no es un backup.
- [ ] **Retención:** conservar al menos 30 días de copias diarias y 3 mensuales.

## 5. WAF y seguridad a nivel de hosting

- [ ] Contratar hosting con **firewall de aplicaciones web (WAF)** incluido o activar el del proveedor (muchos hostings gestionados lo traen).
- [ ] Activar **protección anti-DDoS** básica del hosting o de Cloudflare (plan gratuito válido para empezar).
- [ ] **SSL/TLS:** certificado válido en todo el dominio, redirección permanente de `http://` a `https://`, y HSTS si el hosting lo soporta.
- [ ] Aislamiento: si el hosting es compartido, que las cuentas estén aisladas (preguntar al proveedor); mejor aún, hosting gestionado WordPress.
- [ ] Desactivar en el hosting lo que no se use: versiones viejas de PHP (usar **PHP 8.2+** [VERIFICAR versión recomendada por WordPress en 2026]), FTP sin cifrar (usar SFTP).

## 6. Permisos de archivos y directorios

Valores recomendados en el servidor:

- Directorios: **755** · Archivos: **644** · `wp-config.php`: **600** (o 640 según el hosting).
- [ ] Comprobar que ningún archivo o carpeta tiene permiso `777`.
- [ ] El usuario del servidor web debe ser dueño de los archivos; evitar propiedad `root` en la raíz pública.

## 7. `.htaccess` — reglas recomendadas

En la raíz del sitio (Apache; si el hosting usa Nginx, pedir al soporte las equivalencias):

```apache
# Proteger wp-config.php
<files wp-config.php>
    order allow,deny
    deny from all
</files>

# Bloquear xmlrpc.php (vector clásico de ataques de fuerza bruta y DDoS)
<files xmlrpc.php>
    order allow,deny
    deny from all
</files>

# Desactivar el listado de directorios
Options -Indexes

# Proteger el propio .htaccess
<files ~ "^.*\.([Hh][Tt][Aa])">
    order allow,deny
    deny from all
</files>
```

> Nota: si algún plugin necesita `xmlrpc.php` (p. ej. la app móvil de WordPress o Jetpack), no lo bloquees del todo: usa el plugin de seguridad para limitarlo en su lugar.

## 8. Cabeceras de seguridad

Configurar en el hosting o en `.htaccess` (pedir ayuda al soporte si no hay acceso):

- `Strict-Transport-Security` (HSTS): fuerza HTTPS.
- `X-Content-Type-Options: nosniff`
- `X-Frame-Options: SAMEORIGIN` (o `frame-ancestors` en CSP) — evita clickjacking.
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Permissions-Policy` básica (desactivar cámara, micrófono, geolocalización si no se usan).
- `Content-Security-Policy`: la más potente y la más delicada; empezar en modo `report-only`, revisar los reportes una semana y luego activarla. Cuidado: una CSP mal puesta rompe AdSense y los scripts de afiliados — probar bien.

## 9. Anti-spam y moderación de comentarios

- [ ] Instalar **Akismet** (viene con WordPress) o **Antispam Bee** y activarlo.
- [ ] `Ajustes → Comentarios`: moderar **todos** los comentarios antes de publicarlos (al menos los primeros meses).
- [ ] Desactivar comentarios en páginas estáticas y en reseñas si no aportan (menos spam, menos moderación).
- [ ] Añadir honeypot o captcha ligero si el spam persiste (el plugin de seguridad suele incluirlo).
- [ ] Los enlaces en comentarios llevan `nofollow` por defecto en WordPress: no tocar esa opción.

## 10. Política de plugins mínimos

Regla: **cada plugin es una puerta potencial; instala solo lo imprescindible.**

Lista corta permitida para EcoHogar:

1. **Seguridad:** Wordfence Security *o* Sucuri Security (uno solo, no los dos).
2. **Backup:** UpdraftPlus (configurado con destino externo).
3. **SEO:** Rank Math *o* Yoast SEO (uno solo).
4. **Rendimiento:** caché (el del hosting si lo ofrece; si no, WP Rocket de pago o LiteSpeed Cache si el servidor es LiteSpeed).
5. **Antispam:** Akismet o Antispam Bee.
6. **2FA:** el módulo del plugin de seguridad (evita un plugin extra).
7. **Formularios:** solo si la página de contacto lo necesita (Fluent Forms o WPForms lite).

Prohibido: plugins abandonados (sin actualizar en 1+ año), plugins "nulled"/piratas, dos plugins que hagan lo mismo, page builders pesados (el theme es custom y no los necesita).

## 11. Plan de respuesta a incidentes

Si el sitio muestra contenido extraño, redirecciones a otras webs, o Google Search Console alerta de "sitio hackeado":

1. **No entres en pánico ni borres nada todavía.** Haz una captura de lo que ves.
2. **Pon el sitio en mantenimiento** (plugin de maintenance o página estática del hosting) para proteger a los visitantes.
3. **Cambia todas las contraseñas**: admin de WordPress, hosting/panel, SFTP, base de datos.
4. **Escanea** con el plugin de seguridad (Wordfence/Sucuri) y con el escáner de malware del hosting.
5. **Restaura** desde el backup limpio más reciente (por eso se prueban los backups).
6. **Actualiza todo** (núcleo, plugins, theme) y revisa usuarios: elimina cuentas desconocidas.
7. **Rota los salts** de `wp-config.php` (genera unos nuevos: cierra todas las sesiones).
8. **Pide revisión en Google** (Search Console → Problemas de seguridad → Solicitar revisión) cuando esté limpio.
9. **Anota qué pasó** (fecha, síntomas, causa probable) en el log del sitio para no repetirlo.

---

*Revisado el 28-09-2026. Las versiones de PHP y las funciones exactas de cada plugin cambian con el tiempo: verifica la documentación oficial antes de aplicar cambios en producción.*
