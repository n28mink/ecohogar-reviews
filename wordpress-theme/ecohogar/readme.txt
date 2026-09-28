=== EcoHogar ===
Contributors: equipo-ecohogar
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, reviews, green, responsive, translation-ready, custom-menu, featured-images

Theme ligero hecho a medida para EcoHogar, sitio de reseñas de tecnología verde y hogar inteligente. Sin page builders.

== Description ==

EcoHogar incluye:

* Custom Post Type "Reseña" (`single-resena.php`): veredicto destacado, puntuación sobre 10 con estrellas, pros/contras, CTA de afiliado con `rel="sponsored nofollow"`, tabla de especificaciones, precio orientativo, FAQ y disclosure automático de afiliado.
* Plantilla de página "Comparativa" (`page-comparativa.php`): tabla responsive generada desde las reseñas que indiques (slugs o IDs), con el mejor puntuado destacado.
* 5 slots de anuncios para AdSense (Apariencia > Widgets): cabecera, dentro del artículo (se inserta solo tras el 2.º párrafo), barra lateral, in-feed y barra lateral general.
* JSON-LD automático (schema.org): Organization, WebSite, Review (con positiveNotes/negativeNotes), ItemList en comparativas, FAQPage cuando la reseña tiene FAQ y BreadcrumbList.
* Open Graph + Twitter Card automáticos.
* Menús: principal y pie de página. Soporta logo personalizado e imagen destacada.

== Installation ==

1. Descarga o clona este repositorio.
2. Copia la carpeta `ecohogar/` dentro de `wp-content/themes/` de tu WordPress.
3. En el admin ve a Apariencia > Temas y activa "EcoHogar".
4. Ve a Apariencia > Menús y crea el "Menú principal" (categorías: Energía solar, Eficiencia energética, Hogar inteligente, Climatización eficiente, Movilidad eléctrica) y el "Menú pie de página" (Privacidad, Divulgación de afiliados, Contacto).
5. Ve a Apariencia > Widgets y coloca tus códigos de AdSense en los slots "Anuncio: ...".
6. Copia `ads.txt` a la RAÍZ de tu WordPress (https://tudominio.com/ads.txt) con tu ID de editor real.

== Crear una reseña ==

1. Reseñas > Añadir reseña.
2. Completa título, contenido, imagen destacada, categoría y extracto.
3. En el meta box "Ficha de reseña EcoHogar" completa: veredicto, puntuación, pros, contras, precio orientativo, URL de afiliado (con tu ID), especificaciones (formato "Etiqueta: valor", una por línea) y FAQ (formato "Pregunta || Respuesta", una por línea).
4. Publica. La URL quedará como `tudominio.com/resenas/tu-resena/`.

== Crear una comparativa ==

1. Páginas > Añadir nueva.
2. En "Atributos de página > Plantilla" elige "Comparativa".
3. En el meta box lateral "Comparativa EcoHogar" escribe los slugs o IDs de las reseñas separados por comas (ej: `resena-ecoflow-delta-3-plus, resena-tapo-p110m`).
4. Escribe la introducción, la metodología y el análisis en el contenido. La tabla se genera sola.
5. Publica.

== Personalización ==

* Colores y tipografías: edita las variables CSS en `:root` al inicio de `style.css` (`--verde`, `--verde-oscuro`, `--dorado`, etc.).
* Textos del theme: están marcados para traducción (dominio `ecohogar`).
* El disclosure de afiliado aparece automáticamente en reseñas con URL de afiliado; puedes ajustar el texto en `functions.php` (`ecohogar_affiliate_disclosure`).

== Changelog ==

= 1.0.0 =
* Versión inicial: CPT reseña, ficha completa, comparativas, 5 slots de anuncios, JSON-LD (Review/ItemList/FAQ), Open Graph.
