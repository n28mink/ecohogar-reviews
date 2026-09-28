# Estrategia de enlazado interno — EcoHogar

**Fecha:** 28 de septiembre de 2026 · **Objetivo:** que cada pieza nueva refuerce a las anteriores y que el lector (y Google) siempre encuentre el siguiente paso lógico.

---

## 1. Modelo pilares y clusters (hub-and-spoke)

Cada categoría tiene **1 guía pilar** (el hub) y un cluster de reseñas, comparativas y guías secundarias (los spokes). El pilar enlaza hacia abajo a todo el cluster; cada spoke enlaza hacia arriba al pilar y lateralmente a 1–2 piezas hermanas.

| Categoría | Pilar (hub) | Cluster (spokes) |
|---|---|---|
| Energía solar | Autoconsumo solar en casa 2026 (S1, publicada) | Comparativa estaciones de energía portátiles 2026 (S1) · Reseña EcoFlow DELTA 3 Plus (S2) · Comparativa paneles 2026 · Guía cuántos paneles necesita una casa · Guía monocristalino vs policristalino · Reseña inversor híbrido · Guía kit de autoconsumo |
| Eficiencia energética | Cómo reducir el consumo eléctrico en casa (fase 2) | Reseña Google Nest Learning Thermostat 4.ª gen (S3) |
| Hogar inteligente | Qué es Matter y por qué importa (S6) | Reseña TP-Link Tapo P110M (S2) · Reseña Philips Hue kit inicio (S4) · Comparativa bombillas inteligentes 2026 (S6) · Reseña cámara wifi · Reseña cerradura inteligente |
| Climatización eficiente | Cuánto consume un aire acondicionado (S5) | Comparativa aires eficientes 2026 (S5) · Comparativa Daikin vs Mitsubishi (S8) · Reseña aire inverter (S11) |
| Movilidad eléctrica | Bici eléctrica vs patinete — cuál te conviene (S12) | Comparativa patinetes eléctricos 2026 (S3, publicada) · Comparativa bicis eléctricas 2026 (S10) · Reseña bici urbana (S7) |

> Pilares propuestos para fase 2 (cuando el cluster crezca): *Hogar inteligente desde cero* (hogar-inteligente) y *Guía de compra: climatización eficiente* (climatización-eficiente).

### Reglas del modelo
- Ninguna pieza queda huérfana: toda URL recibe al menos 2 enlaces internos desde otras piezas o desde el archivo de categoría.
- El pilar nunca enlaza a afiliados en el primer tercio del artículo (primero informa, después recomienda).
- Las comparativas son los "imanes de enlaces": reciben enlaces desde todas las reseñas de productos que incluyen.

---

## 2. Reglas de anchor text

1. **Descriptivo y natural.** El anchor debe decir a dónde va: *"nuestra comparativa de bombillas inteligentes de 2026"*, *"la guía para dimensionar tus paneles solares"*.
2. **Máximo ~30% de anchors con keyword exacta.** El resto: variaciones parciales, de marca y genéricos ("ver el análisis completo", "te lo explicamos aquí").
3. **Nunca el mismo anchor** para dos destinos distintos.
4. **Contexto antes que lista:** los enlaces van dentro del cuerpo del texto, donde aportan. Nada de bloques de "enlaces relacionados" sin contexto (para eso está el módulo de la sección 4).
5. **Enlaces de afiliado aparte:** los CTA de afiliado llevan `rel="sponsored nofollow"` y NO cuentan como enlazado interno. Nunca mezclar un enlace interno con un enlace de afiliado en el mismo anchor.

### Ejemplos

| ✅ Bien | ❌ Mal |
|---|---|
| "Si todavía no sabes cuánta potencia necesitas, mira [cuántos paneles solares lleva una casa típica]" | "[clic aquí] para más info" |
| "Lo comparamos con el resto en [las mejores bombillas inteligentes de 2026]" | "[bombillas inteligentes] [bombillas inteligentes] [bombillas inteligentes]" (3 iguales) |
| "El [análisis completo del Nest Learning Thermostat] muestra un ahorro real de…" | "[termostato inteligente opiniones] barato" (keyword stuffing) |

---

## 3. Qué enlazar en cada tipo de pieza

### Reseña individual (`single-resena.php`)
- **Obligatorio:** 1 enlace al pilar de su categoría + 1 enlace a la comparativa donde aparece el producto.
- **Recomendado:** 1 enlace lateral a otra reseña del mismo cluster ("si buscás algo más barato…").
- **CTA de afiliado:** al final de la ficha y tras el veredicto; marcado `sponsored nofollow`.
- Dónde: veredicto → comparativa; sección "alternativas" → reseñas hermanas; cierre → pilar.

### Comparativa (`page-comparativa.php`)
- **Obligatorio:** enlaces a las reseñas individuales de cada producto comparado (si existen) + 1 enlace al pilar.
- **Recomendado:** 1 enlace a la guía informacional que explica los criterios ("cómo elegimos").
- La tabla comparativa enlaza cada producto a su reseña (anchor = nombre del modelo).

### Guía pilar / guía secundaria (post en categoría)
- **Obligatorio:** enlazar hacia abajo a 3–5 piezas del cluster (comparativas y reseñas) en los puntos donde se mencionan.
- **Recomendado:** 1 enlace lateral a otro pilar ("también te puede interesar ahorrar en climatización").
- El pilar es el que más enlaces **recibe**: verificar que cada spoke nuevo lo enlace.

### Páginas (sobre nosotros, contacto, legales)
- No participan del cluster salvo: "Sobre nosotros" enlaza a 2–3 comparativas destacadas como prueba de método; el disclosure de afiliados se enlaza desde el footer de cada pieza con afiliado.

---

## 4. Módulo "Relacionados"

- Ubicación: después del contenido, antes de los comentarios; también 1 bloque in-feed a mitad de artículos largos (+1.500 palabras).
- Lógica: 3 tarjetas de la **misma categoría**, priorizando el mismo cluster; excluir la pieza actual; si hay menos de 3, completar con la comparativa más leída del sitio.
- Override manual: campo en el editor para fijar piezas específicas (útil en comparativas estacionales).
- Nunca mostrar dos veces la misma pieza en una página.

---

## 5. Breadcrumbs

- Patrón: `Inicio › {Categoría} › {Título}` (reseñas y guías) · `Inicio › Comparativas › {Título}` (comparativas).
- Implementación con schema `BreadcrumbList` en `functions.php` del theme.
- El archivo de categoría enlaza de vuelta al pilar destacado ("Empieza por la guía completa").

---

## 6. Mantenimiento trimestral

Cada 3 meses (marcar en el calendario: enero, abril, julio, octubre):

1. **Auditoría de enlaces rotos:** rastrear el sitio (Screaming Frog o plugin) y corregir 404 internos.
2. **Detección de huérfanos:** toda URL con 0 enlaces internos entrantes recibe al menos 2 (o se fusiona/elimina con redirección 301).
3. **Refresco de pilares:** actualizar año, precios y modelos; cambiar la fecha de actualización visible (no la URL).
4. **Revisión de anchors:** buscar sobre-optimización (más del 30% de anchors con keyword exacta hacia una misma URL) y variar.
5. **Search Console:** revisar consultas que traen impresiones sin clics y reforzar el enlazado interno hacia esas URLs desde piezas con tráfico.
6. **Comparativas anuales:** en enero, actualizar título a "…de 2027", re-verificar los 5–7 productos y republicar con fecha de actualización.

---

## 7. Métricas para saber si funciona

- Páginas por sesión y % de clics en "relacionados" (objetivo inicial: subir ambos trimestre a trimestre; sin cifras inventadas de referencia).
- Cobertura de indexación de los 5 pilares en Search Console.
- Crecimiento de impresiones de las keywords comerciales (tabla en `keyword-research.md`) entre el día 30 y el día 90.
