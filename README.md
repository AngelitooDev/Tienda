Proyecto de Scrapeo de Precios y Seguimiento de URLs

Este proyecto permite a los usuarios registrar URLs de productos, extraer y almacenar el precio de estos productos utilizando web scraping. El sistema esta basado en Laravel e incluye los siguientes componentes principales:

Modelos

1. Modelo Tracking

Ubicacion: app/Models/Tracking.php

Descripcion: Este modelo representa un seguimiento o monitoreo creado por un usuario. Cada Tracking puede tener varias URLs relacionadas con precios.

Relacion:
public function prices()
{
return $this->hasMany(Price::class);
}

Relacion uno a muchos con el modelo Price. Cada Tracking puede tener varias entradas de precios.

Campos fillables:
protected $fillable = ['user_id', 'title'];

2. Modelo Price

Ubicacion: app/Models/Price.php

Descripcion: Este modelo almacena los precios obtenidos de las URLs asociadas a un Tracking.

Relacion:
public function tracking()
{
return $this->belongsTo(Tracking::class);
}

Relacion muchos a uno con el modelo Tracking.

Campos fillables:
protected $fillable = ['tracking_id', 'url', 'price'];

Controladores

1. TrackingController

Ubicacion: app/Http/Controllers/TrackingController.php

Responsabilidad: Gestiona las acciones CRUD (Crear, Leer, Actualizar, Eliminar) para los Trackings.

Metodos principales:

index(): Muestra una lista de todos los seguimientos creados por el usuario actual.

create(): Devuelve una vista con el formulario para crear un nuevo Tracking.

store(Request $request): Almacena un nuevo seguimiento en la base de datos.

show(Tracking $tracking): Muestra un seguimiento especifico junto con las URLs de precios relacionadas.

destroy(Tracking $tracking): Elimina un seguimiento.

2. PriceController

Ubicacion: app/Http/Controllers/PriceController.php

Responsabilidad: Gestiona la creacion de precios asociados a un Tracking.

Metodo principal:

store(Request $request, Tracking $tracking, ScraperService $scraper):

Valida la URL proporcionada.

Usa el ScraperService para extraer el precio.

Almacena el precio extraido en la base de datos.

Vistas

1. index.blade.php (Lista de Trackings)

Ubicacion: resources/views/trackings/index.blade.php

Funcion: Muestra una lista de todos los seguimientos del usuario.

Acciones disponibles:

Crear un nuevo Tracking.

Ver detalles de un Tracking.

2. create.blade.php (Formulario de Creacion)

Ubicacion: resources/views/trackings/create.blade.php

Funcion: Muestra el formulario para crear un nuevo Tracking.

Accion: Envia la informacion al metodo store() del TrackingController.

3. show.blade.php (Detalles del Tracking)

Ubicacion: resources/views/trackings/show.blade.php

Funcion: Muestra los detalles de un Tracking especifico junto con la lista de precios obtenidos.

Formulario para agregar una URL: Envia la URL al metodo store() del PriceController.

Servicio de Scraping

ScraperService

Ubicacion: app/Services/ScraperService.php

Responsabilidad: Extraer el precio de la URL proporcionada.

Metodos:

scrapePrice(string $url): Detecta el contenido de la URL y llama al metodo correspondiente segun el tipo de contenido (JSON, XML o HTML).

parseJson(string $body): Extrae el precio si la respuesta es JSON.

parseXml(string $body): Extrae el precio si la respuesta es XML.

parseHtml(string $url): Extrae el precio si la respuesta es HTML mediante Symfony DomCrawler.

Como funciona el scraping de la URL:

Peticion HTTP: Se hace una peticion GET a la URL proporcionada utilizando Http::withHeaders() para evitar bloqueos por parte del servidor.
$response = Http::withHeaders([
'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, como Gecko) Chrome/91.0.4472.124 Safari/537.36',
])->get($url);

Detectar el tipo de contenido: Se verifica si la respuesta es JSON, XML o HTML y se elige el metodo correspondiente para extraer el precio.
$contentType = $response->header('Content-Type');
if (str_contains($contentType, 'application/json')) {
return $this->parseJson($response->body());
} elseif (str_contains($contentType, 'application/xml') || str_contains($contentType, 'text/xml')) {
return $this->parseXml($response->body());
} else {
return $this->parseHtml($url);
}

Scraping del HTML:
Si el contenido es HTML, se utiliza Symfony DomCrawler para seleccionar el elemento que contiene el precio.
$crawler = new Crawler($html);
$priceText = $crawler->filter('.product-price, #our_price_display')->first()->text();

// Limpiar y formatear el precio
$priceText = preg_replace('/[^0-9,.]/', '', $priceText);
$priceText = str_replace('.', '', $priceText);
$priceText = str_replace(',', '.', $priceText);

return floatval($priceText);

Ejemplo de flujo del sistema:

El usuario crea un nuevo Tracking usando el formulario en create.blade.php.

Una vez creado, puede agregar URLs de productos en la vista show.blade.php.

El sistema hace scraping de la URL proporcionada, extrae el precio y lo almacena en la base de datos.

Los precios guardados se muestran en la misma vista de Tracking.
