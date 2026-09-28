# EcoHogar — Sitio de reseñas de tecnología verde y hogar inteligente

Paquete completo de implementación en WordPress: estrategia SEO, theme custom ligero, 7 artículos iniciales listos para publicar, guías de monetización (AdSense + afiliados), hardening de seguridad y checklists de instalación y lanzamiento.

> **Estado:** paquete v1.0.0 listo para instalar. No se ha instalado en ningún hosting todavía: eso lo haces tú con el checklist de `checklists/`.

## Marca

**EcoHogar** — *Tecnología verde y hogar inteligente.* Reseñas honestas en español de productos que ahorran energía, bajan la factura y hacen la casa más inteligente: energía solar, eficiencia energética, hogar inteligente, climatización eficiente y movilidad eléctrica ligera.

## Estructura del repo

| Carpeta | Contenido |
|---|---|
| `plan/` | Estrategia: arquitectura del sitio, keyword research (20-30 keywords priorizadas), calendario editorial de 90 días, estrategia de enlazado interno |
| `wordpress-theme/ecohogar/` | Theme WordPress custom desde cero (sin page builders): ficha de reseña, comparativas, slots AdSense, JSON-LD, Open Graph |
| `contenido/` | 7 artículos en español, cada uno en Markdown y en HTML listo para pegar en WordPress (4 reseñas, 2 comparativas, 1 guía pilar) |
| `monetizacion/` | Guía AdSense 2026, guía de afiliados (Amazon + alternativas), plantilla de divulgación de afiliados |
| `seguridad/` | Checklist de hardening WordPress (2FA, backups 3-2-1, WAF, wp-config, .htaccess, respuesta a incidentes) |
| `checklists/` | Instalación en hosting paso a paso, QA pre-lanzamiento, lanzamiento y post-lanzamiento |

## Puesta en marcha (resumen)

1. Lee `checklists/instalacion-hosting.md` y sigue el paso a paso (comprar dominio + hosting, instalar WordPress, SSL).
2. Sube el theme: copia `wordpress-theme/ecohogar/` a `wp-content/themes/` y actívalo (instrucciones en `wordpress-theme/ecohogar/readme.txt`).
3. Crea las 5 categorías y los menús según `plan/arquitectura.md`.
4. Publica los artículos de `contenido/` (usa la versión `.html`, pégala en el editor): primero crea cada producto como **Reseña** completando la ficha, luego las comparativas.
5. Reemplaza todos los `[VERIFICAR]` por datos confirmados y pon tu ID de afiliado donde veas `TU-ID-21`.
6. Copia `wordpress-theme/ecohogar/ads.txt` a la raíz del sitio con tu ID de AdSense y sigue `monetizacion/guia-adsense.md` para solicitar la aprobación.
7. Repasa `checklists/qa-prelanzamiento.md` antes de anunciar el sitio.

## Monetización

* **Google AdSense:** el theme trae 5 slots (cabecera, dentro del artículo, barra lateral, in-feed). Guía completa en `monetizacion/guia-adsense.md`.
* **Afiliados:** todos los CTA usan `rel="sponsored nofollow"` y cada reseña muestra disclosure automático. Guía en `monetizacion/guia-afiliados.md` + plantilla legal en `monetizacion/plantilla-divulgacion-afiliados.md`.

## Decisiones de diseño

* **Sin page builders ni dependencias:** solo WordPress + este theme. Rápido y fácil de mantener.
* **Contenido honesto:** veredicto arriba, pros/contras reales, precios marcados como orientativos con fecha. Lo no verificado va marcado `[VERIFICAR]`: no publiques sin resolverlo.
* **SEO desde el día uno:** JSON-LD (Review, ItemList, FAQ), Open Graph, URLs limpias (`/resenas/...`), enlazado interno planificado en `plan/`.

## Licencia

Código del theme: GPLv2 o posterior (compatible con WordPress). Contenidos editoriales: todos los derechos reservados a EcoHogar.
