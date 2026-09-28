# QA pre-lanzamiento — EcoHogar

Revisión completa antes de abrir el sitio al público y de solicitar AdSense. No lances con casillas sin marcar: cada una tiene su motivo.

---

## 1. QA técnico

- [ ] **Responsive:** revisar portada, una reseña, una comparativa y la guía en móvil (375 px), tablet y escritorio. Nada de texto cortado, tablas que se salgan ni botones superpuestos. La tabla comparativa debe hacer scroll horizontal o apilarse en móvil.
- [ ] **Velocidad:** medir con PageSpeed Insights la portada y una reseña. Objetivo: Core Web Vitals en verde o amarillo en móvil. Si está en rojo, optimizar imágenes (WebP, compresión) y revisar el caché.
- [ ] **Enlaces:** todos los enlaces internos llevan a páginas que existen (sin 404). Probar menú, pie, migas de pan, paginación y el buscador.
- [ ] **Enlaces de afiliado:** cada CTA abre el producto correcto, en pestaña nueva, con `rel="sponsored nofollow"`. Ningún enlace de ejemplo (`#`) en producción.
- [ ] **Formularios:** el formulario de contacto envía y llega el correo; el mensaje de confirmación se muestra.
- [ ] **HTTPS:** todo el sitio carga con candado, sin avisos de "contenido mixto" (imágenes o scripts en `http://`).
- [ ] **Favicon y logo:** visibles en la pestaña del navegador y en móvil.
- [ ] **404 y búsquedas vacías:** la página de error 404 es amable y ofrece volver al inicio; una búsqueda sin resultados muestra un mensaje útil.
- [ ] **Backups:** el primer backup automático ya se ejecutó y se descargó una copia de prueba.

## 2. QA de contenido

- [ ] **Ortografía y redacción:** releer cada artículo en voz alta o con un corrector; nada de lorem ipsum ni textos de relleno.
- [ ] **Datos:** no queda ningún `[VERIFICAR]` sin resolver en el contenido publicado. Precios: solo "precio orientativo con fecha de consulta" o "Ver precio en Amazon"; nunca una cifra presentada como precio vigente en la tienda.
- [ ] **Estructura de cada pieza:** veredicto claro arriba, para quién es / para quién no, pros/contras, especificaciones, alternativas, FAQ y disclosure de afiliado.
- [ ] **Disclosures:** versión corta al inicio de cada artículo con afiliados; versión micro junto a cada CTA; página de divulgación publicada y enlazada en el pie.
- [ ] **Imágenes:** todas cargan, tienen texto alternativo descriptivo y son propias o con licencia (nada descargado de Amazon salvo vía sus herramientas oficiales).
- [ ] **Coherencia de marca:** mismo nombre, mismos colores y mismo tono en todas las páginas.
- [ ] **Fechas:** las reseñas dicen "2026" donde corresponde; nada de "próximamente" en contenido publicado.

## 3. SEO

- [ ] **Titles y meta descriptions:** únicos en cada página, con la keyword principal y menos de 60 / 160 caracteres respectivamente.
- [ ] **Una sola etiqueta H1** por página; jerarquía H2/H3 lógica.
- [ ] **Sitemap:** generado (Rank Math) y enviado a Search Console; `robots.txt` no bloquea nada importante.
- [ ] **Schema:** el JSON-LD de Review/ItemList/FAQ del theme se renderiza sin errores (validar una reseña y una comparativa en la herramienta Rich Results Test de Google).
- [ ] **Open Graph:** al compartir un artículo en WhatsApp/Telegram se ve título, imagen y descripción correctos.
- [ ] **Enlazado interno:** cada reseña enlaza a su comparativa y a la guía pilar; la guía pilar enlaza a las reseñas. Sin páginas huérfanas entre el contenido inicial.
- [ ] **URLs:** limpias, en español, sin fechas ni IDs (`/mejor-termostato-inteligente-2026/`, no `/?p=123`).
- [ ] **Analytics:** GA4 instalado y registrando visitas reales (comprobar en tiempo real).

## 4. Legal y monetización

- [ ] Páginas publicadas y enlazadas en el pie: Sobre nosotros, Contacto, Política de privacidad, Términos, Divulgación de afiliados.
- [ ] La política de privacidad menciona: AdSense/cookies publicitarias, Google Analytics y enlaces de afiliado.
- [ ] `ads.txt` accesible en `tudominio.com/ads.txt` con el ID de editor **real**.
- [ ] Código de AdSense instalado pero **sin anuncios inventados**: hasta la aprobación, los slots pueden mostrarse vacíos o con un marcador discreto.
- [ ] Cuenta de Amazon Afiliados creada y el ID de afiliado (`tu-id-21`) ya está en los enlaces.

## 5. Seguridad (resumen; detalle en `seguridad/hardening-wordpress.md`)

- [ ] WordPress, plugins y theme actualizados; auto-updates activados.
- [ ] Usuario `admin` eliminado o renombrado; 2FA activo en administradores; contraseñas fuertes.
- [ ] `DISALLOW_FILE_EDIT` y salts únicos en `wp-config.php`; SSL forzado en el admin.
- [ ] Reglas `.htaccess` aplicadas (proteger `wp-config.php`, bloquear `xmlrpc.php`, sin listado de directorios).
- [ ] Solo los plugins de la lista mínima instalada; temas inactivos borrados.
- [ ] Comentarios en moderación manual; antispam activo.

---

**Criterio de salida:** todo marcado. Si algo no se puede cumplir antes del lanzamiento (p. ej. la aprobación de AdSense, que llega después), anótalo como pendiente con fecha en el checklist de post-lanzamiento.
