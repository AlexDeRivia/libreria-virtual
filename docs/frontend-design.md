# Dirección visual · Librería Virtual

La interfaz representa una biblioteca contemporánea. La ficha de cada ejemplar y el recorrido de un pedido son los elementos visuales principales; los datos administrativos usan la misma jerarquía y paleta.

## Sistema de color

| Token | Valor | Uso |
| --- | --- | --- |
| Tinta | `#17343B` | Texto principal |
| Verde profundo | `#123E45` | Navegación y cubiertas |
| Verde de acción | `#0C6970` | Acciones y enlaces |
| Coral de índice | `#A94731` | Énfasis secundario y acciones destructivas |
| Niebla | `#F1F7F6` | Fondo general |
| Blanco | `#FFFFFF` | Superficies de lectura |

## Tipo y disposición

- **Trebuchet MS / Aptos Display** para títulos, cabeceras y cubiertas; **Aptos / Segoe UI** para texto y formularios. La tipografía se sirve desde el sistema para que la demo funcione sin servicios externos.
- Títulos y cuerpo alineados a la izquierda. Líneas de lectura de hasta unas 70 letras. Datos numéricos con cifras tabulares.
- Espaciado de 8, 16, 24, 32 y 48 px; bordes visibles en fichas y tablas. El color de fondo separa navegación, contenido y acciones.

```text
Portada:   [marca / navegación] [relato + acciones | estantería]
           [tres pasos del recorrido] [entrada al catálogo]

Catálogo:  [título + explicación     | búsqueda]
           [ficha] [ficha] [ficha]

Pedido:    [ejemplares y controles    | resumen + confirmar]
Móvil:     [ejemplares]
           [resumen + confirmar]

Gestión:   [menú] [título de sección]
                  [acciones] [tabla o formulario]
Móvil:     [menú plegable] [título] [tabla desplazable]
```

La estantería ilustrada es la única pieza decorativa destacada. Las fichas de libros son representaciones deliberadas de cubiertas porque el catálogo de demostración no incluye portadas reales. Se evitó una propuesta inicial en marrón y ámbar, y también testimonios inventados, para mantener el proyecto reconocible y honesto.

## Interacción y accesibilidad

- Navegación semántica, enlace para saltar al contenido, foco visible y botones con nombre accesible.
- Tablas administrativas con desplazamiento interno en móvil; acciones destructivas piden confirmación.
- Movimiento reducido respetado; transiciones limitadas a color, borde y sombra.
- Los estados vacíos indican el siguiente paso y los formularios mantienen etiquetas visibles.
