# Guía AdSense para EcoHogar

> **Fecha de consulta de las políticas:** 28 de septiembre de 2026.
> AdSense cambia sus políticas y umbrales cada cierto tiempo; verifica siempre la versión vigente en el centro de ayuda de AdSense antes de actuar.

EcoHogar encaja bien en AdSense: un sitio de reseñas con contenido original, comparativas y guías genera páginas con mucho texto y alta intención de lectura, lo que suele dar buenos ingresos por cada mil impresiones (RPM).

---

## 1. Requisitos de aprobación (2026)

AdSense no tiene un número mínimo oficial de artículos ni de visitas. Lo que evalúa es **calidad y originalidad del contenido**, más unas páginas de confianza básicas. La regla práctica para un sitio nuevo:

- **Contenido original y sustancial:** apunta a 15-25 artículos publicados de calidad (las reseñas, comparativas y guías de este repo ya cubren una buena base) antes de solicitar la cuenta. El motivo más común de rechazo en 2026 sigue siendo el "contenido de poco valor": textos cortos, genéricos o copiados no pasan.
- **Páginas de confianza obligatorias:** Sobre nosotros / Quiénes somos, Contacto, Política de privacidad, Aviso legal o Términos. En un sitio con afiliados, también una página de divulgación de afiliados (ver `monetizacion/plantilla-divulgacion-afiliados.md`).
- **Dominio propio** y sitio completamente navegable: sin páginas en construcción, sin errores 404 masivos, menú funcional, velocidad de carga razonable.
- **Tráfico orgánico:** no hay mínimo oficial, pero el sitio debe estar indexado en Google y recibir algunas visitas reales. Cuidado: **no compres paquetes de "clics en AdSense" ni tráfico incentivizado**; Google lo detecta y suspende la cuenta.
- **Edad del titular:** 18 años o más. Si el titular es menor, la cuenta debe estar a nombre de un adulto.

### Proceso de solicitud

1. Crear la cuenta en AdSense con una cuenta de Google, indicando la URL del sitio.
2. Verificar la propiedad del sitio (subir el archivo HTML que te da AdSense, o la etiqueta en `<head>`; si ya usas Google Search Console con el mismo método, puede aprovecharse).
3. Pegar el código de anuncios en el sitio (en el theme ecohogar hay slots dedicados; ver punto 3).
4. Enviar el sitio a revisión. La revisión suele tardar **unos días a dos semanas**; un sitio acabado y limpio normalmente se aprueba en menos de una semana.
5. No canceles y reenvíes la solicitud: cada reenvío va al final de la cola. Si te rechazan, corrige lo indicado y vuelve a intentarlo.

### Identidad, dirección y pagos (vigente 2026)

- **Verificación de identidad:** desde junio de 2026 Google exige verificar la identidad **antes de que la cuenta pueda empezar a mostrar anuncios y recibir pagos**. El umbral de verificación de identidad bajó a **$0**. Deberás subir un documento oficial con foto; según el país, también pueden pedir un video-selfie.
- **Verificación de dirección:** al alcanzar unos **$10** de ingresos, Google envía por correo postal un PIN de 6 dígitos a tu dirección registrada. Introduce el PIN en AdSense. Si la carta no llega, puedes solicitar reenvíos (hasta 3 intentos); si fallan, AdSense ofrece métodos alternativos con documentos.
- **Umbral de pago:** **$100 USD** acumulados (equivalentes según la moneda de la cuenta). Los pagos se emiten mensualmente, **entre el 21 y el 26** del mes siguiente, siempre que hayas superado el umbral y tengas completadas la verificación y la información fiscal. Si no llegas, el saldo se acumula al mes siguiente.
- **Método de pago:** transferencia bancaria; el nombre del titular de la cuenta AdSense debe coincidir exactamente con el de la cuenta bancaria.

### Políticas de contenido que más afectan a un sitio de reseñas

- **Contenido original:** prohibido el contenido copiado o "scraped" (reseñas copiadas de Amazon, textos generados en masa sin valor añadido).
- **Tráfico inválido:** está terminantemente prohibido hacer clic en tus propios anuncios, pedir a otros que lo hagan, o usar bots. Una suspensión por tráfico inválido es prácticamente irreversible.
- **Contenido engañoso:** no prometas productos, precios o descuentos que no existan; los CTAs deben llevar a lo que anuncian.
- **Colocación de anuncios:** los anuncios no pueden tapar el contenido, ni colocarse junto a elementos interactivos de forma que provoquen clics accidentales (por ejemplo, pegados a botones de navegación o a flechas de galerías), ni en páginas sin contenido.
- **Contenido sensible:** las reseñas de tecnología verde no suelen tocarlo, pero evita publicar sobre temas restringidos (contenido para adultos, violencia, drogas, etc.) porque contaminan toda la cuenta.

## 2. ads.txt

`ads.txt` (Authorized Digital Sellers) es un archivo de texto en la raíz del dominio (`tudominio.com/ads.txt`) que declara qué sistemas publicitarios están autorizados a vender tu inventario. **Google no lo exige, pero lo recomienda encarecidamente**; si detecta un problema, verás una alerta en tu panel.

Ejemplo con el ID de editor de ejemplo (reemplaza `pub-0000000000000000` por tu ID real, que encuentras en AdSense → Cuenta → Información de la cuenta):

```
# ads.txt de ejemplo para EcoHogar
# Reemplaza pub-0000000000000000 con tu ID de editor real de AdSense
google.com, pub-0000000000000000, DIRECT, f08c47fec0942fa0
```

El theme incluye este archivo de ejemplo en `wordpress-theme/ecohogar/ads.txt` y el checklist de instalación explica cómo subirlo a la raíz del dominio.

## 3. Placements recomendados para un sitio de reseñas

| Ubicación | Qué es | Pros | Contras |
|---|---|---|---|
| **Header (debajo del menú)** | Banner horizontal arriba del todo | Muy visible, buen CTR | Puede empujar el contenido hacia abajo; evita que parezca el titular del artículo |
| **In-article (dentro del artículo)** | Bloques entre párrafos | El mejor rendimiento en sitios editoriales: el lector ya está enganchado | No abuses: 2-3 por artículo largo; más densidad baja la experiencia y puede violar políticas |
| **Sidebar (sticky)** | Columna lateral que acompaña el scroll | Impresiones constantes sin interrumpir la lectura | En móvil la sidebar suele ir al final: menos impacto; en pantallas pequeñas puede no renderizarse |
| **In-feed (entre tarjetas)** | Anuncios nativos entre las fichas de archivo/comparativas | Se integran con el diseño, buen rendimiento en listados | Requieren configuración del estilo para que parezcan nativos sin engañar |
| **Anchor (anclado abajo en móvil)** | Banner fijo en la parte inferior en móviles | Alto viewability en tráfico móvil | Puede resultar intrusivo; Google limita su frecuencia automáticamente |
| **Vignette (pantalla completa al cambiar de página)** | Intersticial de página completa | CPM alto | El más intrusivo: úsalo con moderación o desactívalo si priorizas la experiencia |

**Recomendación inicial para EcoHogar:** activar Auto Ads con solo *in-page* (header, in-article, sidebar) y probar anchor en móvil; dejar vignette desactivado hasta tener tráfico estable. Después de 2-4 semanas, revisar el informe de rendimiento por formato y ajustar.

## 4. Auto Ads vs bloques manuales

- **Auto Ads:** Google coloca los anuncios automáticamente donde su algoritmo cree que rendirán mejor. Ventaja: cero mantenimiento, aprende solo. Desventaja: menos control sobre dónde aparecen.
- **Bloques manuales:** tú defines cada posición en el theme (los slots del theme ecohogar están pensados para esto). Ventaja: control total, puedes excluir zonas (por ejemplo, no poner anuncios entre el veredicto y los pros/contras). Desventaja: hay que probar y ajustar a mano.

**Estrategia sugerida:** empezar con bloques manuales en las posiciones clave del theme (header, in-article, sidebar) para tener control desde el día uno, y activar Auto Ads solo como complemento en páginas de archivo si quieres. No uses ambos a la vez sin revisar: los anuncios pueden duplicarse y saturar la página.

## 5. Errores comunes que causan rechazo o limitación de anuncios

1. **Solicitar la cuenta con el sitio a medio hacer:** páginas "en construcción", lorem ipsum, menú roto.
2. **Contenido de poco valor:** artículos de 300 palabras genéricos, reseñas copiadas de la ficha del fabricante.
3. **Falta de páginas legales:** sin política de privacidad ni página de contacto, el rechazo es casi seguro.
4. **Clicar tus propios anuncios** o pedir a amigos/familia que lo hagan: suspensión casi garantizada.
5. **Comprar tráfico barato o bots** para "acelerar" la aprobación.
6. **Demasiados anuncios sobre el contenido** o anuncios que tapan texto en móvil: limitación de publicación de anuncios.
7. **Modificar el código de AdSense** o colocar anuncios en ventanas emergentes, correos o apps no declaradas.
8. **Contenido duplicado entre tus propias páginas** (misma reseña con otro título).
9. **No declarar el ads.txt** cuando AdSense lo alerta durante semanas (no suspende, pero pierdes ingresos por compradores que exigen ads.txt).
10. **Solicitar la cuenta con un dominio recién registrado y cero contenido indexado:** espera a tener el sitio completo y algunas semanas de vida.

## 6. Checklist pre-solicitud

- [ ] 15-25 artículos originales publicados (reseñas, comparativas, guías), cada uno con 800+ palabras útiles.
- [ ] Páginas publicadas: Sobre nosotros, Contacto, Política de privacidad, Términos/Aviso legal, Divulgación de afiliados.
- [ ] Sin `[VERIFICAR]` pendientes en el contenido publicado (o marcados como tales visiblemente si son provisionales).
- [ ] Disclosure de afiliados visible en todos los artículos con enlaces de afiliado.
- [ ] Menú, buscador, categorías y paginación funcionando; sin enlaces rotos (revisar con el QA pre-lanzamiento).
- [ ] Sitio responsive y rápido en móvil (Core Web Vitals en verde o amarillo).
- [ ] `ads.txt` subido a la raíz con tu ID de editor real.
- [ ] Sitio indexado en Google (comprobar en Search Console) con algo de tráfico orgánico.
- [ ] Titular mayor de 18 años y datos de la cuenta reales y consistentes.
- [ ] Código de AdSense instalado en todas las páginas (vía el theme) antes de enviar a revisión.

---

*Fuentes consultadas el 28-09-2026: documentación de ayuda de AdSense sobre verificación de identidad (umbral $0 desde junio 2026) y umbrales de pago; guías de aprobación 2026. Los umbrales pueden variar según país y moneda de la cuenta.*
