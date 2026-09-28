# Instalación en hosting — paso a paso para Abraham

Guía pensada para ejecutar sin conocimientos técnicos: sigue los pasos en orden y marca cada casilla. Si algo no coincide con lo que ves en pantalla, **para y pregunta** antes de improvisar.

**Tiempo estimado:** 2-3 horas la primera vez (más el tiempo de propagación del dominio, que puede tardar unas horas).

---

## Paso 1. Dominio + hosting: qué contratar

- [ ] **Dominio:** nombre corto, fácil de deletrear, con la marca elegida (p. ej. `ecohogar.reviews`, `ecohogar.tech` o similar). Extensiones recomendadas: `.com` primero; si no está libre, `.net`, `.io` o `.tech`. Evita guiones y números.
- [ ] **Hosting:** busca un **hosting gestionado para WordPress** (ellos se encargan de actualizaciones del servidor, backups base y SSL). Qué debe incluir sí o sí:
  - Certificado **SSL gratis** (Let's Encrypt) con renovación automática.
  - **Backups automáticos** diarios.
  - Soporte en español, idealmente con chat.
  - PHP 8.2+ y MySQL/MariaDB actualizados.
  - Instalador de WordPress en 1 clic.
- [ ] Registra el dominio y contrata el hosting **en el mismo proveedor** si puedes: te ahorra configurar DNS a mano.
- [ ] Guarda en tu gestor de contraseñas: usuario y clave del panel del hosting, y el correo de la cuenta.

## Paso 2. Apuntar el dominio y activar el SSL

- [ ] Si el dominio y el hosting están en proveedores distintos, cambia los **nameservers** del dominio por los que te indique el hosting (te los dan en el correo de bienvenida o en su panel).
- [ ] Espera a que el dominio resuelva a tu hosting (puede tardar de minutos a unas horas). Compruébalo entrando a `tudominio.com`: deberías ver la página del hosting o el instalador.
- [ ] Activa el **SSL** desde el panel del hosting y fuerza HTTPS (casi todos tienen un interruptor "Forzar HTTPS"). Comprueba que `https://tudominio.com` carga con el candado.

## Paso 3. Instalar WordPress

- [ ] En el panel del hosting, usa el **instalador de WordPress en 1 clic**.
- [ ] Datos a poner:
  - **Título del sitio:** el nombre de la marca (p. ej. "EcoHogar").
  - **Usuario administrador:** un nombre NO obvio (nada de `admin`).
  - **Contraseña:** genera una larga con el botón del instalador y guárdala en tu gestor de contraseñas.
  - **Correo:** uno que revises de verdad (ahí llegan avisos de seguridad).
- [ ] Entra a `tudominio.com/wp-admin` con esas credenciales y comprueba que ves el escritorio de WordPress.

## Paso 4. Instalar el theme ecohogar

- [ ] En tu computadora, abre la carpeta `wordpress-theme/ecohogar/` de este repo y **comprímela en un ZIP** (el ZIP debe contener la carpeta del theme con `style.css` dentro, no una carpeta extra por encima).
- [ ] En WordPress: **Apariencia → Temas → Añadir nuevo → Subir tema** → selecciona el ZIP → Instalar y **Activar**.
- [ ] Comprueba que la portada carga y se ve el diseño del theme (menú, portada, pie).
- [ ] Sube el archivo **`ads.txt`** de ejemplo a la **raíz del dominio** (donde está `wp-config.php`, no dentro de `wp-content`). Puedes hacerlo desde el **Administrador de archivos** del panel del hosting: subir archivo → `ads.txt`. Más adelante lo editarás con tu ID real de AdSense (ver Paso 9).

## Paso 5. Plugins mínimos (instalar y activar, nada más)

Desde **Plugins → Añadir nuevo**, instala **uno de cada grupo**:

- [ ] Seguridad: **Wordfence Security** (luego activa el 2FA en tu usuario).
- [ ] Backup: **UpdraftPlus** → configúralo para enviar copias a tu Google Drive (te guía el asistente del plugin).
- [ ] SEO: **Rank Math** (asistente de configuración inicial: conecta con Search Console cuando te lo pida).
- [ ] Caché: el que recomiende tu hosting (muchos lo traen integrado; si no, **LiteSpeed Cache** si tu servidor es LiteSpeed).
- [ ] Antispam: **Akismet** (necesita una key gratuita que se consigue en su web) o **Antispam Bee** (sin key).
- [ ] **Borra** los plugins que vengan preinstalados y no necesites (p. ej. Hello Dolly).

## Paso 6. Ajustes iniciales de WordPress

- [ ] **Ajustes → Generales:** título, descripción corta, zona horaria (América/Caracas), idioma español.
- [ ] **Ajustes → Enlaces permanentes:** elige **"Nombre de la entrada"** (URLs limpias: `tudominio.com/mi-resena/`).
- [ ] **Ajustes → Lectura:** de momento deja la portada mostrando las últimas entradas (luego podrás poner una portada fija).
- [ ] **Ajustes → Comentarios:** activa "El comentario debe aprobarse manualmente".
- [ ] **Ajustes → Medios:** tamaños de imagen razonables (el theme ya define los suyos; no toques nada si no sabes).
- [ ] **Usuarios → Tu perfil:** activa el **2FA** (Wordfence → Login Security → activa para tu usuario y escanea el QR con tu app de autenticación).
- [ ] **Apariencia → Menús:** crea el menú principal con: Inicio, Reseñas, Comparativas, Guías y las categorías (Energía solar, Eficiencia energética, Hogar inteligente, Climatización, Movilidad eléctrica).
- [ ] **Apariencia → Widgets:** coloca los bloques de anuncio/HTML en los slots del theme (sidebar, etc.) cuando tengas el código de AdSense.

## Paso 7. Páginas legales y de confianza (crear como "Páginas", no entradas)

Crea estas páginas desde **Páginas → Añadir nueva** (usa los textos de este repo como base):

- [ ] **Sobre nosotros** — quién está detrás, qué criterios usan las reseñas.
- [ ] **Contacto** — formulario o correo de contacto.
- [ ] **Política de privacidad** — el plugin de Rank Math o el asistente de WordPress (**Ajustes → Privacidad**) te da una plantilla; adáptala (menciona AdSense, Analytics y afiliados).
- [ ] **Términos / Aviso legal.**
- [ ] **Divulgación de afiliados** — copia la versión completa de `monetizacion/plantilla-divulgacion-afiliados.md`.
- [ ] Añade las 5 al **menú del pie** del sitio.

## Paso 8. Publicar los primeros artículos

Cómo publicar cada tipo de pieza del paquete inicial:

- [ ] **Reseñas** (EcoFlow, Tapo, Nest, Hue): en **Reseñas → Añadir reseña**. Pega el contenido HTML en el editor, pon la imagen destacada y completa la **ficha** del meta box (veredicto, puntuación, pros/contras, precio orientativo con fecha, URL de afiliado, especificaciones, FAQ). Asigna la categoría.
- [ ] **Comparativas** (estaciones de energía, patinetes): en **Páginas → Añadir nueva**, plantilla **"Comparativa"**. Pega el contenido HTML, escribe los slugs de las reseñas en el meta box "Comparativa EcoHogar" y publica.
- [ ] **Guía pilar** (autoconsumo solar): en **Entradas → Añadir nueva**, pega el HTML (pestaña "HTML"/"Código" del editor, no la visual), asigna la categoría `energia-solar` e imagen destacada.
- [ ] Revisa que el **disclosure corto** aparece al inicio del artículo y la **nota micro** junto a cada botón de compra.
- [ ] Reemplaza `TU-ID-21` en los enlaces de afiliado por tu **ID real** de Amazon Afiliados (mantén el `rel="sponsored nofollow"`).
- [ ] Publica primero las 2 comparativas y la guía pilar, y después las reseñas individuales (así el enlazado interno ya tiene a dónde apuntar).

## Paso 9. Conectar AdSense y ads.txt

- [ ] Crea la cuenta de AdSense y verifica el sitio (ver `monetizacion/guia-adsense.md`, checklist pre-solicitud: haz esto cuando tengas los artículos publicados).
- [ ] Cuando Google te dé tu **ID de editor** (`pub-XXXXXXXXXXXXXXXX`), edita el archivo `ads.txt` en la raíz del dominio y reemplaza el ID de ejemplo por el tuyo.
- [ ] Pega el código de anuncios de AdSense en los slots del theme (**Apariencia → Widgets** o el personalizador, según indique el `readme.txt` del theme).
- [ ] Envía el sitio a revisión y espera el correo de aprobación (días a un par de semanas).

## Paso 10. Medición básica

- [ ] Crea una cuenta de **Google Analytics 4** y conecta el sitio (Rank Math lo hace en su asistente, o pega el ID en el theme si tiene campo para ello).
- [ ] Registra el sitio en **Google Search Console** y envía el sitemap (`tudominio.com/sitemap_index.xml`, lo genera Rank Math).
- [ ] Comprueba en Search Console que las páginas se están indexando (tarda días).

---

**Si algo falla:** el soporte del hosting (chat) es tu mejor aliado para los pasos 1-4; para lo de WordPress, revisa el `readme.txt` del theme. No instales plugins "para probar" fuera de la lista del Paso 5.
