Estafeta PHP
================

[![Build Status](https://travis-ci.org/ivansabik/estafeta-php.svg)](https://travis-ci.org/ivansabik/estafeta-php)

Wrapper para proveer funcionalidades de rastreo y cotización de envíos de paquetes de Estafeta. Está basado en la API no oficial, pero a diferencia de ésta no usa la librería DOM Hunter, se realiza el scraping de forma manual con el módulo DOM de PHP. Otra diferencia importante es que provee arreglos asociativos nativos de PHP como respuesta, y no JSON por lo

### Rastreo

Actualmente proporciona la siguiente info (sólo para envíos nacionales):

 - Número de guía
 - Código de rastreo
 - Tipo de servicio
 - Fecha programada de entrega
 - Lugar de origen (nombre y coordenadas usando la API de geolocalización Google Maps)
 - Fecha de recolección
 - Hora de recolección
 - Lugar de destino (nombre, código postal y coordenadas usando la API de geolocalización Google Maps)
 - Estatus del envío
 - Fecha de entrega
 - Hora de entrega
 - Firma y comprobante de recibido
 - Historial de movimientos

### Cotización de sobres y paquetes

Para cotización muestra la info de paquetes y sobres de los siguientes productos:

 - 11:30
 - Día siguiente
 - Dos días
 - Terrestre
 
### Ejemplos

#### Rastreo

```
$estafeta = new Estafeta();
$estafeta->rastrear('2851055655');
$infoEnvio = $estafeta->infoEnvio;
```

#### Cotización de sobre

```
$estafeta = new Estafeta();
$estafeta->cotizar('01210', '86035'); # cp origen, cp destino
$cotizacion = $estafeta->cotizacion;
```

#### Cotización de paquete

```
$estafeta = new Estafeta();
$estafeta->cotizar('01210', '86025', 1, 10, 20, 20); # cp origen, cp destino, peso, alto, largo, ancho
$cotizacion = $estafeta->cotizacion;
```
