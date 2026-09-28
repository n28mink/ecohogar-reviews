# Arquitectura del sitio — EcoHogar

**Fecha:** 28 de septiembre de 2026 · **Estado:** propuesta inicial (no publicada)

---

## 1. Marca y posicionamiento

### Nombre y tagline
- **Marca:** EcoHogar
- **Tagline:** *Tecnología verde y hogar inteligente, reseñada de verdad.*
- **Descriptor SEO (meta description de la home):** Reseñas honestas de tecnología verde y hogar inteligente: paneles solares, eficiencia energética, climatización y movilidad eléctrica. Comparamos, medimos el ahorro y te decimos qué vale la pena.

### Propuesta de valor
EcoHogar no es un catálogo con descripciones copiadas del fabricante. Cada reseña responde una sola pregunta: **¿este producto te ahorra dinero y energía de verdad?** Publicamos veredicto claro arriba, pros y contras reales, especificaciones clave, precio orientativo y para quién sí / para quién no. Lo que no pudimos verificar se marca como tal.

### Tono editorial
- Español neutro latinoamericano (es-419), cercano y directo. Nada de tecnicismos sin explicar.
- Primera persona plural honesta: "probamos", "medimos", "no nos convenció".
- Cero humo marketinero: sin "revolucionario", sin "el mejor del mundo" sin datos.
- Transparencia total con afiliados: disclosure visible en cada pieza con enlaces de afiliado.

### Pilares de contenido (las 5 categorías)
1. Energía solar para el hogar
2. Eficiencia energética
3. Hogar inteligente
4. Climatización eficiente
5. Movilidad eléctrica ligera

---

## 2. Taxonomía

### Categoría 1 — Energía solar para el hogar
- **Slug:** `energia-solar`
- **Descripción:** Paneles, kits de autoconsumo, generadores solares portátiles e inversores: qué comprar, cuánto cuesta y cuánto ahorras de verdad.
- **Subtemas:**
  - Paneles solares residenciales (monocristalinos, comparativas por marca)
  - Kits solares de autoconsumo
  - Generadores / estaciones solares portátiles
  - Inversores híbridos y baterías
  - Instalación, mantenimiento y dimensionado

### Categoría 2 — Eficiencia energética
- **Slug:** `eficiencia-energetica`
- **Descripción:** Cómo gastar menos electricidad en casa: termostatos, medidores de consumo, iluminación LED y hábitos que sí funcionan.
- **Subtemas:**
  - Termostatos inteligentes
  - Enchufes y medidores de consumo eléctrico
  - Iluminación LED eficiente
  - Electrodomésticos de bajo consumo
  - Hábitos y ajustes que reducen la factura

### Categoría 3 — Hogar inteligente
- **Slug:** `hogar-inteligente`
- **Descripción:** Iluminación, asistentes de voz, seguridad y automatización: monta tu casa conectada sin volverte loco.
- **Subtemas:**
  - Iluminación inteligente (bombillas, tiras LED)
  - Asistentes de voz y altavoces (Alexa, Google Home)
  - Seguridad: cámaras wifi y cerraduras inteligentes
  - Sensores, hubs y automatizaciones
  - Estándar Matter y compatibilidad

### Categoría 4 — Climatización eficiente
- **Slug:** `climatizacion-eficiente`
- **Descripción:** Aire acondicionado inverter, bombas de calor y ventilación: confort térmico gastando menos.
- **Subtemas:**
  - Aires acondicionados inverter (comparativas por marca)
  - Bombas de calor y calefacción eficiente
  - Ventiladores y enfriadores de bajo consumo
  - Purificadores y calidad del aire
  - Dimensionado: qué potencia necesitas según tu espacio

### Categoría 5 — Movilidad eléctrica ligera
- **Slug:** `movilidad-electrica`
- **Descripción:** Bicicletas y patinetes eléctricos: autonomía real, precios y cuál te conviene según tu uso.
- **Subtemas:**
  - Bicicletas eléctricas urbanas
  - Bicicletas eléctricas plegables
  - Patinetes eléctricos
  - Autonomía, baterías y tiempos de carga
  - Accesorios, seguridad y mantenimiento

---

## 3. Tipos de contenido y patrones de URL

| Tipo | Template WP | Patrón de URL | Ejemplo |
|---|---|---|---|
| Reseña individual | `single-resena.php` (CPT `resena`) | `/resenas/{slug-producto}/` | `/resenas/resena-philips-hue-kit-inicio/` |
| Comparativa | `page-comparativa.php` | `/{slug}/` | `/comparativa-mejores-estaciones-energia-portatil-2026/` |
| Guía pilar | `single.php` (post en categoría) | `/{categoria}/{slug}/` | `/energia-solar/guia-autoconsumo-solar-casa-2026/` |
| Guía secundaria | `single.php` (post en categoría) | `/{categoria}/{slug}/` | `/energia-solar/panel-solar-monocristalino-vs-policristalino/` |
| Archivo de categoría | `archive.php` | `/{categoria}/` | `/energia-solar/` |
| Página estática | `page.php` | `/{slug}/` | `/sobre-nosotros/` |

### Reglas de URL
- Todo en minúsculas, con guiones, sin tildes ni eñes, sin fechas en el slug (la fecha vive en el título y en el contenido actualizable).
- Las comparativas llevan el año en el título visible ("…de 2026"), no en la URL, para poder actualizarlas sin romper enlaces.
- Una sola categoría por pieza (la principal); el resto de relaciones se resuelven con enlazado interno (ver `enlazado-interno.md`).

---

## 4. Mapa del sitio inicial

### Home (`/`)
Hero con propuesta de valor + últimas comparativas + top reseñas + acceso a las 5 categorías + newsletter (opcional, fase 2).

### Archivos de categoría (5)
- `/energia-solar/` · `/eficiencia-energetica/` · `/hogar-inteligente/` · `/climatizacion-eficiente/` · `/movilidad-electrica/`
- Cada archivo: descripción de la categoría, guía pilar destacada, listado de reseñas y comparativas.

### Artículos iniciales (7) — en `contenido/`, ver `calendario-editorial-90-dias.md`, semanas 1–4
1. Reseña: EcoFlow DELTA 3 Plus → `/resenas/resena-ecoflow-delta-3-plus/`
2. Reseña: TP-Link Tapo P110M → `/resenas/resena-tapo-p110m/`
3. Reseña: Google Nest Learning Thermostat (4.ª gen) → `/resenas/resena-nest-learning-thermostat-4gen/`
4. Reseña: Philips Hue White and Colour Ambiance (kit de inicio) → `/resenas/resena-philips-hue-kit-inicio/`
5. Comparativa: Las 5 mejores estaciones de energía portátiles de 2026 → `/comparativa-mejores-estaciones-energia-portatil-2026/`
6. Comparativa: Los 5 mejores patinetes eléctricos de 2026 → `/comparativa-mejores-patinetes-electricos-2026/`
7. Guía pilar: Autoconsumo solar en casa 2026 → `/energia-solar/guia-autoconsumo-solar-casa-2026/` (post en categoría)

### Páginas (5)
- `/sobre-nosotros/` — quiénes somos, cómo probamos, equipo.
- `/contacto/` — formulario + correo.
- `/divulgacion-de-afiliados/` — cómo ganamos dinero, política de reseñas independientes.
- `/politica-de-privacidad/` — requerida por AdSense.
- `/aviso-legal/` — titularidad, cookies, jurisdicción.

---

## 5. Menús de navegación

### Menú principal (header)
- Inicio
- Energía solar ▸ (subtemas: Paneles residenciales · Kits de autoconsumo · Generadores portátiles)
- Eficiencia energética
- Hogar inteligente
- Climatización eficiente
- Movilidad eléctrica
- Comparativas
- Guías

### Menú footer
- Sobre nosotros · Contacto · Divulgación de afiliados · Política de privacidad · Aviso legal

### Sidebar (en artículos)
- Buscador, categorías, "Comparativas más leídas", slot AdSense, newsletter (fase 2).

### Breadcrumbs
`Inicio › {Categoría} › {Título de la pieza}` en reseñas y guías; `Inicio › Comparativas › {Título}` en comparativas. Con schema `BreadcrumbList` (ver `functions.php` del theme).

---

## 6. Decisiones de arquitectura (registro)

1. **CPT separado para reseñas** (`resena` → `/resenas/`): permite ficha estructurada (veredicto, pros/contras, puntuación, specs) y schema `Review` limpio, sin pelear con el loop de posts.
2. **Comparativas como páginas con template propio**: son contenido "evergreen" que se actualiza cada año; el slug sin año evita redirecciones anuales.
3. **Guías pilar dentro de la categoría** (`/{categoria}/{slug}/`): refuerzan la autoridad temática del silo y concentran los enlaces internos del cluster.
