# Guía de afiliados para EcoHogar

> **Fecha de consulta:** 28 de septiembre de 2026.
> Los programas cambian comisiones, cookies y condiciones sin aviso. Antes de publicar, verifica los términos vigentes en la página oficial de cada programa. Lo que no se pudo verificar se marca `[VERIFICAR]`.

Estrategia recomendada: **Amazon Afiliados como base** (convierte muy bien porque la gente ya confía en Amazon y compra de todo) + **1-2 redes o programas directos** con mejores comisiones para las categorías estrella del sitio (iluminación inteligente, energía solar, climatización).

---

## 1. Amazon Afiliados (Amazon Associates)

### Cómo funciona

Te registras en el programa del país de tu audiencia (Amazon España `amazon.es`, Amazon México `amazon.com.mx`, Amazon EE. UU. `amazon.com` [VERIFICAR cuál conviene según el tráfico real]). Amazon te da un **ID de afiliado** (formato `tunombre-21` en España). Con la barra de herramientas "SiteStripe" generas enlaces con tu ID para cualquier producto. Si alguien compra tras hacer clic, ganas una comisión sobre el precio.

### Condiciones clave (2026)

- **Cookie: 24 horas.** Si el visitante compra dentro de las 24 horas tras el clic, ganas la comisión. Excepción importante: **si añade el producto al carrito dentro de esas 24 horas, la ventana se extiende a 90 días** (siempre que complete la compra de ese carrito).
- **Compras de otros productos también comisionan:** si entra por tu enlace de un panel solar pero acaba comprando unos auriculares, también ganas comisión por esos auriculares.
- **La cookie vive en el navegador y dispositivo del clic.** Si hace clic en el móvil y compra en el portátil, no hay comisión.
- **Comisiones por categoría:** varían por país y categoría (electrónica y hogar suelen estar entre el 3% y el 4-5% en España [VERIFICAR tabla vigente]). Los porcentajes exactos están en la tabla de comisiones de tu cuenta de afiliado.
- **Umbral y forma de pago:** Amazon paga por transferencia o cheque regalo según el país, con un mínimo acumulado (p. ej. 25 € en España [VERIFICAR]). Revisa tu panel.

### Reglas estrictas (incumplirlas = expulsión)

1. **Precios: no muestres precios fijos.** Los precios de Amazon cambian constantemente; está prohibido publicar un precio estático ("25,99 €") salvo que uses la API oficial (Product Advertising API) con actualización automática. En el contenido escribe **"Ver precio en Amazon"** y deja que el precio se vea en Amazon.
2. **Disclosure obligatorio:** Amazon exige una declaración clara y visible, con el texto oficial: *"En calidad de Afiliado de Amazon, obtengo ingresos por las compras adscritas que cumplen los requisitos aplicables."* Debe estar en cada página con enlaces de afiliado, sin necesidad de hacer scroll para verla (o justo antes del primer enlace).
3. **No compres con tus propios enlaces.** Prohibido usar tus enlaces para tus compras, y también pedir a familiares, amigos o empleados que compren a través de ellos.
4. **No incentives los clics.** Prohibido ofrecer recompensas, sorteos o descuentos a cambio de usar tus enlaces.
5. **Enlaces claros:** no uses acortadores opacos (tipo bit.ly) que oculten que el destino es Amazon. Usa el formato `amazon.es/dp/ASIN?tag=tu-id-21` o el acortador oficial `amzn.to`.
6. **Imágenes:** no alojes en tu servidor imágenes descargadas de Amazon salvo que uses sus herramientas oficiales (SiteStripe/API). Enlaza o usa fotos propias.
7. **No copies reseñas de Amazon** ni las pegues en tu sitio: resume el sentimiento general con tus palabras.
8. **No sugieras que Amazon te respalda** ni uses su marca de forma que parezca una relación oficial más allá del programa de afiliados.
9. **Sin rastreo de precios:** tu sitio no puede ofrecer alertas o historiales de precios basados en datos de Amazon.
10. **Email:** Amazon restringe el uso de enlaces de afiliado en correos masivos y newsletters; revísalo en las condiciones vigentes antes de incluirlos.

### Marcado de enlaces

Todos los enlaces de afiliado de Amazon en el theme llevan:

```html
<a href="https://www.amazon.es/dp/B0XXXXXXX?tag=tu-id-21"
   rel="sponsored nofollow" target="_blank">Ver precio en Amazon</a>
```

- `rel="sponsored"` → le dice a Google que es un enlace pagado (obligatorio para SEO).
- `nofollow` → refuerzo adicional; Google recomienda `sponsored`, y la combinación `sponsored nofollow` es la práctica habitual y segura.
- `target="_blank"` → abre en pestaña nueva para no sacar al lector del artículo.

## 2. Programas alternativos para tech verde y hogar inteligente

### Awin (red de afiliados global)

- **Qué es:** una de las redes de afiliación más grandes del mundo, con decenas de miles de anunciantes en tecnología, retail y hogar. Opera en España y Latinoamérica.
- **Por qué encaja:** en Awin hay programas directos de marcas de hogar inteligente muy relevantes para EcoHogar. Ejemplo verificado en listados de 2026: **Philips Hue** (iluminación inteligente) con ~4% de comisión y cookie de ~45 días a través de Awin.
- **Condiciones típicas:** la cookie suele ser de **30 días** (varía por anunciante); pagos dos veces al mes (días 1 y 15) una vez validadas las comisiones; umbral mínimo bajo (~20 $/€ [VERIFICAR]). El registro pide un pequeño depósito reembolsable (~5 $) que se devuelve al llegar al primer pago [VERIFICAR].
- **Cómo usarlo:** regístrate como editor, busca anunciantes de "smart home", "energía" o "climatización" que operen en tu país, solicita unirte a cada programa y genera tus enlaces.
- **Ventaja frente a Amazon:** comisiones por marca a veces mejores y cookies mucho más largas (30-45 días vs 24 horas).

### Programas directos de marcas (contacto directo)

Varias marcas de energía solar portátil, baterías y hogar inteligente tienen programa propio o trabajan con redes como Impact o CJ. Candidatos naturales para EcoHogar:

- **EcoFlow** (estaciones de energía portátiles y paneles solares): programa de afiliados propio [VERIFICAR existencia y condiciones vigentes].
- **Anker / Anker Solix** (baterías portátiles y solar): programa de afiliados [VERIFICAR].
- **Google Nest / Philips Hue / Tado** (hogar inteligente y termostatos): suelen estar en Awin u otras redes según el país [VERIFICAR disponibilidad en España/Latam].

Cómo conseguirlos: escribe a la marca (página de "Afiliados" o "Partners" en su web) cuando el sitio tenga tráfico demostrable; los programas directos suelen pagar mejor que las redes pero exigen un mínimo de visitas.

### eBay Partner Network (red alternativa) [VERIFICAR]

- Red de afiliados de eBay, útil como complemento para productos descatalogados o de segunda mano (p. ej. termostatos o altavoces inteligentes de generaciones anteriores, muy buscados por precio).
- Comisiones y cookie varían por categoría; verifica condiciones vigentes antes de usarla.

## 3. Dónde y cómo poner el disclosure (FTC / UE)

La normativa (FTC en EE. UU., y en la UE la Directiva de prácticas comerciales desleales aplicada por cada país) exige que la relación comercial sea **clara, visible y previa al enlace**:

1. **Al inicio del artículo**, antes del primer enlace de afiliado: un aviso corto y en lenguaje normal. Ejemplo: *"Este artículo contiene enlaces de afiliado: si compras a través de ellos, ganamos una comisión sin coste extra para ti. [Más información]"*.
2. **Junto a cada CTA de compra**, una micro-nota ("Enlace de afiliado") o que el propio botón lo indique.
3. **Página de divulgación completa** enlazada desde el aviso (ver `plantilla-divulgacion-afiliados.md`) y desde el pie del sitio.
4. **No vale:** esconderlo al final del artículo, ponerlo solo en la página de divulgación, usar letra diminuta o lenguaje ambiguo ("podríamos recibir una compensación" sin decir de quién).
5. En Amazon, además, el texto oficial del programa debe aparecer **visible sin scroll** o inmediatamente antes del primer enlace.

## 4. Buenas prácticas editoriales

- Recomienda solo productos que encajen con el análisis del artículo; el lector nota cuándo un "veredicto" está comprado.
- El orden de las comparativas debe responder a criterios explicados (eficiencia, precio, funciones), no a quién paga más comisión. Si un producto con mejor comisión queda primero, que sea porque ganó la comparativa.
- Actualiza las reseñas cuando el fabricante saca un modelo nuevo; una reseña desactualizada pierde posiciones y confianza.
- No uses más de un programa de afiliados por producto en el mismo CTA: un botón, un destino claro.

---

*Fuentes consultadas el 28-09-2026: condiciones del programa Amazon Associates (políticas oficiales), listados de programas de afiliación 2026 (Awin, Philips Hue vía Awin). Comisiones exactas y programas directos marcados [VERIFICAR] deben confirmarse en las páginas oficiales antes de publicar.*
