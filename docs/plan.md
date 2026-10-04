# Plan de rediseño web ANASCOR para Claude Code

Oct 4, 2026 · @Leonel

## Resumen

Este plan describe el rediseño completo de anascor.org con Laravel, Livewire, Tailwind CSS, MySQL y Filament, dividido en 8 fases que se entregan a Claude Code una por una.

**Objetivo general.** Rediseñar el sitio de la Asociación Nacional de Sordos de Costa Rica (ANASCOR), organización sin fines de lucro que defiende los derechos de las personas sordas, promueve la LESCO y la educación de niños y jóvenes sordos.

**Alcance.**

- Sitio público administrable: inicio, ANASCOR, LESCO, galería, comités, noticias, eventos y contacto.
- Panel Filament para que la junta administre todo el contenido sin tocar código.
- Registro y acceso de personas asociadas, con control de cuotas y morosidad.
- Barra de accesibilidad (contraste y tamaño de letra) inspirada en [cnse.es](https://www.cnse.es/).

**Cómo usar este plan con Claude Code.**

1. Cree una carpeta vacía para el proyecto y guarde este documento dentro como `docs/PLAN.md` (se exporta a Markdown desde el menú del documento).
2. Abra Claude Code en esa carpeta y pegue el prompt de la Fase 0 (sección «Fases de trabajo»).
3. Avance una fase por sesión. Revise el resultado en el navegador y haga commit antes de pasar a la siguiente.
4. Si algo no coincide con el plan, corrija primero `docs/PLAN.md` y luego pida el cambio.

## Stack técnico y decisiones

Un solo proyecto Laravel sirve el sitio público, el panel de administración y el área de asociados sobre una misma base de datos MySQL.

| Capa | Tecnología | Uso |
| --- | --- | --- |
| Backend | Laravel (última versión estable), PHP 8.3+ | Rutas, modelos Eloquent, migraciones, seeders |
| Interactividad | Livewire 3 + Alpine.js | Buscador, carrusel, acordeones, paginación de galería, formulario de contacto |
| Estilos | Tailwind CSS | Diseño responsive; fuente Roboto; temas de contraste con variables CSS |
| Base de datos | MySQL 8 | Todas las tablas del sitio y de asociados |
| Administración | Filament (versión estable compatible con el Laravel instalado) | Panel `/admin` para contenido y asociados |
| Archivos | Disco `public` de Laravel + plugin Spatie Media Library para Filament | Imágenes de noticias, galerías, juntas, logos |
| Video | YouTube embebido (solo se guarda la URL) | Misión, visión y páginas de LESCO |

**Decisiones de diseño.**

- Idioma único: español (`es_CR`), zona horaria `America/Costa_Rica`.
- URLs en español con slugs: `/noticias/{slug}`, `/eventos/{slug}`, `/galeria/{slug}`, `/comites/{slug}`.
- Todo texto e imagen visible sale de la base de datos; ningún contenido queda fijo en las vistas Blade.
- Campo `activo` (0 o 1) en las tablas de contenido para publicar u ocultar sin borrar. En convenios y academias se llama `status`, como se pidió.
- Dos accesos separados: `users` para administradores del panel y `asociados` para personas asociadas (guard propio).
- Los videos deben poder verse sin audio: el contenido principal es LESCO, con texto descriptivo al lado.

## Mapa del sitio, menús y rutas

El menú principal tiene cinco entradas: ANASCOR, LESCO, Galería, Comités y Contacto; solo ANASCOR despliega submenú.

| Página | Ruta | Menú |
| --- | --- | --- |
| Inicio | `/` | Logo |
| ¿Qué es la ANASCOR? | `/anascor/quienes-somos` | ANASCOR |
| Nuestro Trabajo | `/anascor/nuestro-trabajo` | ANASCOR |
| Historia de las Asociaciones | `/anascor/historia` | ANASCOR |
| Estructura Administración de ANASCOR | `/anascor/estructura` | ANASCOR |
| Ex-presidentes de ANASCOR: Liderazgo que deja huella | `/anascor/expresidentes` | ANASCOR |
| Convenio con las academias de LESCO | `/anascor/academias` | ANASCOR |
| Convenio con Hellen AI y SignBridge | `/anascor/convenios` | ANASCOR |
| Federación Mundial de Sordos | Enlace externo a wfdeaf.org (pestaña nueva) | ANASCOR |
| LESCO | `/lesco` | LESCO |
| Galería (álbumes) | `/galeria` | Galería |
| Álbum | `/galeria/{slug}` | — |
| Comités | `/comites` | Comités |
| Detalle de comité | `/comites/{slug}` | — |
| Contacto | `/contacto` | Contacto |
| Noticias | `/noticias` | Inicio y pie |
| Detalle de noticia | `/noticias/{slug}` | — |
| Eventos | `/eventos` | Inicio y pie |
| Detalle de evento | `/eventos/{slug}` | — |
| Resultados de búsqueda | `/buscar?q=` | Encabezado |
| Acceso de asociados | `/asociados/ingresar` | Encabezado (botón) |
| Mi perfil de asociado | `/asociados/perfil` | Área privada |
| Panel de administración | `/admin` | Sin enlace público |

Las rutas actuales del sitio (`/quienes`, `/valores`, `/expresidentes`, `/estructura`, `/historia`, `/academias`, `/convenios`, `/galleria`) deben redirigir con 301 a las nuevas para no perder enlaces ni posicionamiento.

**Encabezado (todas las páginas).** Barra superior de accesibilidad (contraste, fuente/letra), logo de ANASCOR a la izquierda, menú principal, campo «Buscar» y botón «Asociados». En móvil, menú tipo hamburguesa.

**Pie (todas las páginas).** Logo de ANASCOR, columna «Páginas», columna «Recursos», «Síganos» con Facebook e Instagram (y TikTok, que ya aparece en la página de contacto actual), y la línea «© {año actual} ANASCOR. Reservados todos los derechos.» con el año calculado automáticamente.

## Especificación de cada página

Cada página lista lo que muestra y de qué tabla lo toma; las referencias apuntan al sitio actual.

### Inicio

1. **Carrusel.** Varias imágenes con título opcional y enlace; cambio automático con botón de pausa y flechas. Tabla `slides`.
2. **Noticias.** 4 tarjetas (imagen y título) de las más recientes; botón «Más noticias» hacia `/noticias`. Debe haber al menos 8 noticias cargadas de ejemplo. Tabla `noticias`.
3. **Eventos próximos.** Tarjetas con nombre y fecha, solo eventos con fecha de hoy en adelante, ordenados por fecha. Cada tarjeta entera enlaza a `/eventos/{slug}`. Tabla `eventos`.

### Noticias y eventos

- `/noticias`: cuadrícula paginada (12 por página) con imagen, título y fecha.
- `/noticias/{slug}`: imagen principal, título, fecha, contenido y video opcional.
- `/eventos`: próximos primero; los pasados en un bloque aparte.
- `/eventos/{slug}`: nombre, fecha y hora, lugar, imagen, descripción y comité organizador si lo tiene.

### ¿Qué es la ANASCOR?

Referencia: [anascor.org/quienes](https://anascor.org/quienes).

- Texto de presentación y lista de razones de la fundación (8 de junio de 1974), editable desde el panel. Tabla `paginas` (clave `quienes-somos`).
- Junta directiva actual: cuadrícula con foto, nombre y puesto, ordenada por jerarquía. Tabla `miembros_junta`.

### Nuestro Trabajo

- Sin cifra de personas sordas por ahora: queda un campo opcional en el panel (cifra y fuente) que solo se muestra si se llena. Tabla `ajustes`.
- **Misión:** descripción; el video de YouTube se agrega más adelante.
- **Visión:** descripción; el video de YouTube se agrega más adelante.
- **Valores:** cuadrícula de tarjetas como en [anascor.org/valores](https://anascor.org/valores). Los 13 valores actuales se cargan en el seeder: Compromiso con las personas sordas, Dignidad, Responsabilidad, Honestidad, Transparencia, Compromiso, Excelencia, Respeto, Empatía, Trabajo, Disciplina, Solidaridad y Tolerancia. Tabla `valores`.

### Historia de las Asociaciones

Cronograma (línea de tiempo vertical) ordenado por año: año, título, imagen y descripción. Tabla `hitos_historia`.

### Estructura Administración de ANASCOR

Imagen del organigrama, ampliable al hacer clic, con texto alternativo que describa la estructura. Tabla `paginas` (clave `estructura`).

### Ex-presidentes de ANASCOR: Liderazgo que deja huella

Cuadrícula de 4 columnas (2 en tableta, 1 en móvil): imagen, nombre y años de presidencia. Orden del más reciente al más antiguo. Tabla `expresidentes`.

### Convenio con las academias de LESCO

Tres columnas: imagen o logo de la academia, nombre y enlace a su sitio (pestaña nueva). Solo se muestran las que tienen `status = 1`. Tabla `academias`.

### Convenio con Hellen AI y SignBridge

Una tarjeta por convenio: logo, nombre, descripción y enlace. Solo `status = 1`. Tabla `convenios`.

### LESCO

- Sección «¿Qué es la LESCO?» con descripción; el video de YouTube se agrega más adelante.
- Acordeones (uno abierto a la vez), cada uno con descripción y video opcional; aún no hay videos de LESCO, así que el bloque de video se oculta mientras no haya URL:
  - Legislación de LESCO
  - Día de la LESCO
  - Día Internacional de la Lengua de Señas
- Los acordeones salen de la tabla `lesco_secciones`, así se pueden agregar más desde el panel.

### Galería

Referencia: [anascor.org/galleria](https://anascor.org/galleria).

- `/galeria`: cuadrícula de 4 columnas con la portada de cada álbum, su título y su año. Tabla `albumes`.
- `/galeria/{slug}`: fotos del álbum paginadas de 20 en 20; clic abre la foto en grande con anterior y siguiente. Tabla `fotos`.

### Comités

- `/comites`: listado con logo y nombre de cada comité. Tabla `comites`.
- `/comites/{slug}`: descripción del comité, personas encargadas (foto, nombre, cargo, descripción) y sus próximos eventos. Tablas `comite_miembros` y `eventos`.

### Contacto

Referencia: [anascor.org/contacto](https://anascor.org/contacto).

- Dirección: Provincia San José, Cantón Central, Barrio Escalante; 300 metros norte de la Iglesia Santa Teresita, 25 este a mano derecha, casa n.º 2350.
- Correo, enlaces a Facebook, Instagram y TikTok, y mapa de Google embebido.
- Formulario (nombre, correo, asunto, mensaje) que guarda en `mensajes_contacto` y avisa por correo a ANASCOR. Protección contra spam con campo trampa (honeypot) y límite de envíos.
- Quitar el texto de relleno «Calle Principal 1234 / Ciudad, Estado, 12345» que aparece hoy.

### Buscar

Búsqueda en noticias, eventos, comités y páginas; resultados agrupados por tipo.

## Accesibilidad

La barra superior ofrece los mismos controles que [cnse.es](https://www.cnse.es/): contraste y fuente/letra, recordados entre visitas.

| Control | Opciones | Implementación |
| --- | --- | --- |
| Contraste | Por defecto, modo noche, alto contraste negro/blanco, negro/amarillo, amarillo/negro | Atributo `data-tema` en `<html>` y variables CSS; se guarda en `localStorage` |
| Fuente/letra | Pequeña (87,5 %), por defecto (100 %), grande (125 %) | Tamaño base en `<html>`; todo el diseño en unidades `rem` |

**Requisitos generales.**

- Fuente Roboto, alojada en el propio servidor (sin depender de Google Fonts).
- Cumplir WCAG 2.1 nivel AA: contraste mínimo 4,5:1, foco visible, navegación completa por teclado, enlace «Saltar al contenido».
- Ninguna información depende del sonido. Los videos de YouTube se cargan sin reproducción automática y siempre llevan descripción en texto.
- Texto alternativo obligatorio en el panel para toda imagen de contenido.
- Carrusel con botón de pausa y sin cambios bruscos; respetar `prefers-reduced-motion`.
- Diseño pensado primero para móvil; imágenes en WebP con carga diferida.

## Base de datos MySQL

Una sola base de datos `anascor` (utf8mb4) con 22 tablas propias más las de roles y permisos, creadas con migraciones de Laravel; todas llevan `id`, `created_at` y `updated_at`.

### Contenido del sitio

| Tabla | Campos | Notas |
| --- | --- | --- |
| `slides` | titulo (nullable), imagen, alt, enlace (nullable), orden, activo | Carrusel de inicio |
| `noticias` | titulo, slug (único), resumen, contenido (longText), imagen, alt, video\_url (nullable), publicado\_en (datetime), activo | Índice en `publicado_en` |
| `eventos` | nombre, slug (único), descripcion, imagen (nullable), lugar, inicia\_en (datetime), termina\_en (nullable), comite\_id (FK nullable), activo | Índice en `inicia_en` |
| `paginas` | clave (única), titulo, contenido (longText), imagen (nullable), alt, video\_url (nullable) | Claves: `quienes-somos`, `mision`, `vision`, `estructura`, `que-es-lesco` |
| `miembros_junta` | nombre, puesto, foto, periodo, orden, activo | Junta directiva actual |
| `valores` | nombre, descripcion (nullable), icono (nullable), orden, activo | 13 valores iniciales |
| `hitos_historia` | anio (smallint), titulo, descripcion, imagen (nullable), alt, orden | Cronograma |
| `expresidentes` | nombre, foto, anio\_inicio, anio\_fin (nullable), orden | Cuadrícula de 4 |
| `academias` | nombre, imagen, url, status (tinyint 0/1), orden | Convenio con academias |
| `convenios` | nombre, descripcion, imagen, url, status (tinyint 0/1), orden | Hellen AI, SignBridge |
| `lesco_secciones` | titulo, slug, descripcion, video\_url (nullable), orden, activo | Acordeones de LESCO |
| `albumes` | titulo, slug (único), anio, portada, descripcion (nullable), activo | Galería |
| `fotos` | album\_id (FK, cascade), imagen, alt, orden | Más de 20 por álbum, paginadas |
| `comites` | nombre, slug (único), logo, descripcion, orden, activo |  |
| `comite_miembros` | comite\_id (FK, cascade), nombre, cargo, descripcion, foto (nullable), orden | Personas encargadas |
| `mensajes_contacto` | nombre, correo, asunto, mensaje, leido (boolean) | Formulario de contacto |
| `ajustes` | clave (única), valor (text) | Dirección, correo, redes, mapa, cifra opcional de personas sordas (vacía por ahora), días de gracia, correo de tesorería y montos de los planes |

### Ubicación de Costa Rica

| Tabla | Campos | Notas |
| --- | --- | --- |
| `provincias` | nombre | Las 7 provincias, por seeder |
| `cantones` | provincia\_id (FK), nombre | Por seeder, según la división territorial oficial |

### Personas asociadas

| Tabla | Campos | Notas |
| --- | --- | --- |
| `asociados` | nombre\_completo, cedula (única), fecha\_nacimiento (date), provincia\_id (FK), canton\_id (FK), ciudad (texto libre), direccion (text), correo (nullable, único), telefono (nullable), password, fecha\_afiliacion (date), fecha\_inicio (date), fecha\_fin (date nullable), plan\_cuota (mensual, trimestral o anual), pagado\_hasta (date nullable), moroso (boolean, calculado), activo, remember\_token | Índices en `cedula` y `moroso` |
| `pagos_cuota` | asociado\_id (FK), plan (mensual, trimestral o anual), monto (decimal 10,2), cubre\_desde (date), cubre\_hasta (date), pagado\_en (date), comprobante (nullable), registrado\_por (FK a `users`) | Obligatoria: de aquí se calcula `moroso` automáticamente |

### Administración

| Tabla | Campos | Notas |
| --- | --- | --- |
| `users` | name, email, password | Administradores del panel Filament |
| `roles`, `permissions` y pivotes | Las de Spatie Laravel Permission | Roles: Administrador, Editor, Tesorería |

**Relaciones principales.** Un álbum tiene muchas fotos. Un comité tiene muchos miembros y muchos eventos. Una provincia tiene muchos cantones. Un asociado pertenece a una provincia y a un cantón, y tiene muchos pagos.

**Datos personales.** La cédula, la dirección y el estado de morosidad son datos personales protegidos por la Ley 8968 de Costa Rica: nunca se muestran en el sitio público, solo en el panel y en el perfil del propio asociado.

## Panel de administración Filament

El panel en `/admin` tiene un recurso por cada tabla de contenido, agrupados en seis secciones del menú lateral y en español.

| Grupo del menú | Recursos |
| --- | --- |
| Inicio | Carrusel, Noticias, Eventos |
| ANASCOR | Páginas, Junta directiva, Valores, Historia, Ex-presidentes, Academias, Convenios |
| LESCO | Secciones de LESCO |
| Galería y comités | Álbumes (con sus fotos), Comités (con sus miembros) |
| Asociados | Personas asociadas, Pagos de cuota |
| Configuración | Ajustes del sitio, Mensajes de contacto, Usuarios y roles |

**Comportamiento esperado.**

- Subida de imágenes con vista previa, recorte y campo de texto alternativo obligatorio.
- Subida múltiple de fotos dentro de un álbum y orden por arrastre en todas las listas con campo `orden`.
- Slug generado automáticamente desde el título, editable.
- Interruptor para `activo` y `status`; filtro por estado en cada listado.
- Campo de URL de YouTube con validación y vista previa del video.
- Asociados: filtros por provincia, cantón y morosos; selects dependientes provincia → cantón; exportación a Excel.
- Tablero inicial con contadores: asociados activos, morosos, próximos eventos y mensajes sin leer.

**Roles.**

| Rol | Puede |
| --- | --- |
| Administrador | Todo, incluidos usuarios y ajustes |
| Editor | Contenido del sitio; no ve asociados ni pagos |
| Tesorería | Asociados y pagos; no edita contenido |

## Área de personas asociadas

Las personas asociadas entran con su cédula y una contraseña a un perfil privado, separado del panel de administración.

| Dato | Quién lo edita | Tipo |
| --- | --- | --- |
| Nombre completo | Administración | Texto |
| Cédula | Administración | Texto, única |
| Fecha de nacimiento | Administración | Fecha |
| Provincia | Asociado y administración | Lista (7 provincias) |
| Cantón | Asociado y administración | Lista dependiente de la provincia |
| Ciudad | Asociado y administración | Texto libre |
| Dirección de la casa | Asociado y administración | Texto largo |
| Fecha de afiliación | Administración | Fecha |
| Fecha inicio de asociado | Administración | Fecha |
| Fecha fin de asociado | Administración | Fecha, vacía si sigue activo |
| Moroso | Nadie: se calcula desde los pagos | Sí / No |
| Cuota | Administración | Plan: ₡5.000 mensual, ₡15.000 trimestral o ₡60.000 anual |

**Flujo.**

1. Administración crea a la persona asociada en Filament; no hay registro público abierto.
2. Administración genera una contraseña temporal y la entrega en persona; el sistema obliga a cambiarla en el primer ingreso.
3. Ingresa en `/asociados/ingresar` con cédula y contraseña.
4. En `/asociados/perfil` ve sus datos, su estado (al día o moroso), su cuota y su historial de pagos; solo puede editar dirección y datos de contacto.

**Seguridad.** Guard `asociado` independiente del de administradores, contraseñas con hash, límite de intentos de ingreso y páginas privadas sin indexación en buscadores.

**Cuotas y morosidad.**

| Plan | Monto | Cubre |
| --- | --- | --- |
| Mensual | ₡5.000 | 1 mes |
| Trimestral | ₡15.000 | 3 meses |
| Anual | ₡60.000 | 12 meses |

- Tesorería registra cada pago en Filament eligiendo el plan; el sistema llena el monto y calcula `cubre_hasta`.
- `pagado_hasta` del asociado es el `cubre_hasta` más reciente. La persona queda morosa cuando pasan 3 días de gracia después de esa fecha (el número de días es editable en los ajustes); nadie marca el campo a mano.
- Una tarea programada diaria recalcula la morosidad y envía a tesoanascor@gmail.com, el correo de tesorería (guardado en `ajustes`) la lista de personas que pasaron a morosas ese día.
- Tesorería puede cambiar los montos de los planes desde «Ajustes del sitio» sin tocar código.

## Fases de trabajo y prompts para Claude Code

Son 8 fases; cada una termina con algo que se puede abrir y revisar en el navegador antes de continuar.

| Fase | Entrega | Cómo se comprueba |
| --- | --- | --- |
| 0. Preparación | Proyecto Laravel con Livewire, Tailwind, Filament y MySQL; `CLAUDE.md` con las reglas del proyecto | `/` y `/admin` cargan |
| 1. Base de datos | Migraciones, modelos, relaciones, factories y seeders con datos de ejemplo | `php artisan migrate:fresh --seed` sin errores |
| 2. Panel Filament | Recursos de todo el contenido, roles y tablero | Se puede crear una noticia con imagen desde `/admin` |
| 3. Diseño base | Encabezado, menú con submenú, pie, barra de accesibilidad, Roboto | Los 5 modos de contraste y 3 tamaños funcionan |
| 4. Inicio | Carrusel, 4 noticias, eventos próximos, páginas de noticias y eventos | Las tarjetas enlazan a su detalle |
| 5. Páginas internas | ANASCOR (7 páginas), LESCO, Galería, Comités, Contacto, Buscar | Cada ruta del mapa del sitio responde |
| 6. Asociados | Recurso en Filament, ingreso con cédula, perfil, pagos | Un asociado de prueba entra y ve su estado |
| 7. Cierre | Pruebas, redirecciones 301, SEO, revisión de accesibilidad, guía de despliegue en Hostinger (incluye el cron del programador de tareas y el correo SMTP) | `php artisan test` en verde |

**Prompt de la Fase 0** (pegar en Claude Code, con este plan guardado como `docs/PLAN.md`):

```text
Lee docs/PLAN.md completo. Es la especificación del rediseño del sitio de ANASCOR.

Haz solo la Fase 0:
1. Crea un proyecto Laravel (última versión estable) en esta carpeta, con MySQL.
2. Instala Livewire 3, Tailwind CSS y Filament (versión estable compatible).
3. Configura idioma es, locale es_CR y zona horaria America/Costa_Rica.
4. Instala la fuente Roboto alojada localmente y ponla como fuente base en Tailwind.
5. Crea CLAUDE.md con: stack, comandos (servidor, migraciones, pruebas), convenciones
   (nombres de tablas y campos en español como en el plan, URLs en español, todo el
   contenido desde la base de datos) y la regla de trabajar una fase a la vez.
6. Crea un usuario administrador de prueba para /admin.

No avances a la Fase 1. Al terminar, dime qué comandos ejecutar para ver / y /admin.
Si algo del plan es ambiguo, pregúntame antes de decidir.
```

**Prompt para cada fase siguiente** (cambiar el número):

```text
Lee CLAUDE.md y docs/PLAN.md. Haz solo la Fase N tal como está descrita.
Antes de escribir código, muéstrame un plan corto de los archivos que vas a crear
o cambiar y espera mi aprobación.
Al terminar: ejecuta las migraciones y las pruebas, y dime qué URL abrir para revisar.
No modifiques nada de fases anteriores salvo que sea necesario; si lo haces, explícalo.
```

**Indicaciones extra por fase.**

- Fase 1: pedir seeders con al menos 8 noticias, 4 eventos futuros, 1 álbum «Aniversario de ANASCOR» con más de 20 fotos, 3 comités, los 13 valores y las provincias y cantones de Costa Rica. Usar las imágenes reales ya entregadas en public/logo, public/org (organigrama), public/junta y public/galleria/fiesta\_anascor\_50 (álbum del 50 aniversario); el seeder las copia al disco de archivos del panel para que queden administrables.
- Fase 3: pedir que tome como referencia visual [cnse.es](https://www.cnse.es/) solo en estructura (barra de accesibilidad, carrusel, tarjetas de noticias), con los colores del logo de ANASCOR.
- Fase 5: es la más grande; conviene partirla en tres sesiones: ANASCOR, luego LESCO y Galería, luego Comités, Contacto y Buscar.
- Fase 6: pedir pruebas automáticas de que un asociado no puede ver datos de otro ni entrar a `/admin`.
- En cualquier fase: usar el modo de planificación de Claude Code antes de cambios grandes y hacer commit en git al cerrar cada fase.

## Decisiones confirmadas y pendientes

ANASCOR confirmó todas las decisiones el 4 de octubre de 2026; no quedan pendientes y ya se puede empezar la Fase 0.

**Confirmado.**

- **Total de personas sordas:** no se publica ninguna cifra por ahora; el campo queda opcional en el panel.
- **Ciudad:** texto libre; solo provincia y cantón son listas.
- **Moroso:** se calcula desde los pagos registrados y se avisa por correo a tesorería.
- **Cuota:** ₡5.000 por mes, ₡15.000 por tres meses o ₡60.000 por año.
- **Acceso de asociados:** la contraseña se entrega en persona.
- **Videos:** no hay videos de LESCO por ahora; todos los campos de video son opcionales.
- **Convenios:** los nombres Hellen AI y SignBridge son correctos.
- **Material gráfico:** ANASCOR lo tiene y lo entrega.
- **Noticias:** se empieza desde cero; las 8 del seeder son de demostración y se borran antes de publicar.
- **Galería:** del sitio actual solo se migra el álbum del aniversario de ANASCOR.
- **Hospedaje:** Hostinger.
- **Federación Mundial de Sordos:** solo enlace externo.

* **Videos de misión y visión:** aún no hay canal de YouTube; se agregan más adelante desde el panel.
* **Correo de tesorería:** tesoanascor@gmail.com.
* **Plan de Hostinger:** completo, con PHP 8.3, MySQL 8, SSH y cron.
* **Material gráfico:** entregado en `public/logo`, `public/org`, `public/junta` y `public/galleria/fiesta_anascor_50`.

- **Días de gracia:** 3 días después del vencimiento antes de contar a alguien como moroso.
- **Fotos de ex-presidentes y colores institucionales:** ANASCOR los carga por su cuenta desde el panel.

**Pendiente.**

Ninguno. El plan está listo para la Fase 0.

## Fuentes

- [anascor.org/quienes](https://anascor.org/quienes): presentación, menú y pie actuales.
- [anascor.org/valores](https://anascor.org/valores): lista de valores.
- [anascor.org/contacto](https://anascor.org/contacto): dirección, redes y mapa.
- [cnse.es](https://www.cnse.es/): referencia de estructura y accesibilidad.
