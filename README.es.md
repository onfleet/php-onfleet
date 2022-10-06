# Onfleet PHP Wrapper

[![License](https://img.shields.io/github/license/onfleet/php-onfleet)](https://github.com/onfleet/php-onfleet/blob/master/LICENSE)
[![Latest version](https://img.shields.io/packagist/v/onfleet/php-onfleet)](https://google.com)
![Top language](https://img.shields.io/github/languages/top/onfleet/php-onfleet)
[![Downloads](https://img.shields.io/packagist/dt/onfleet/php-onfleet)](https://packagist.org/packages/onfleet/php-onfleet)

> *Consulta este documento en otro idioma*:
> [English](https://github.com/onfleet/php-onfleet/blob/master/README.md)

Los invitamos a visitar nuestra publicación sobre el [proyecto de librerías para la API](https://onfleet.com/blog/api-wrappers-explained/) para conocer más sobre nuestras iniciativas.
En caso de preguntas, pueden contactarnos a través de un issue [aquí](https://github.com/onfleet/pyonfleet/issues) o escribirnos a support@onfleet.com.

## Tabla de contenidos
* [Tabla de contenidos](#tabla-de-contenidos)
* [Sinopsis](#sinopsis)
* [Instalación](#instalación)
* [Requerimientos](#requerimientos)
* [Uso](#uso)
    - [Autenticación](#autenticación)
    - [Límites](#límites)
    - [Operaciones CRUD soportadas](#operaciones-crud-soportadas)
        * [Peticiones GET](#peticiones-get)
            - [Ejemplos de `get()`](#ejemplos-de-get)
            - [Ejemplos de `get(parametro)`](#ejemplos-de-getparametro)
            - [Ejemplos de `getByLocation`](#ejemplos-de-getbylocation)
        * [Peticiones POST](#peticiones-post)
            - [Ejemplos de `create()`](#ejemplos-de-create)
        * [Peticiones PUT](#peticiones-put)
            - [Ejemplos de `update()`](#ejemplos-de-update)
            - [Ejemplos de `insertTask()`](#ejemplos-de-inserttask)
        * [Peticiones DELETE](#peticiones-delete)
            - [Ejemplos de `deleteOne()`](#ejemplos-de-deleteone)
    - [Ejemplos de cómo utilizar las operaciones CRUD](#ejemplos-de-como-utilizar-las-operaciones-crud)
    - [Qué NO hacer](#que-no-hacer)

## Sinopsis
La librería en PHP de Onfleet nos permite un acceso fácil y cómodo a la API de Onfleet.

## Instalación

```
composer require rudiullon/php-onfleet
```

## Requerimientos

La librería de Onfleet para PHP require tener la extensión bcmath [instalada](https://www.php.net/manual/es/bc.installation.php).

## Uso
Antes de usar la librería, es indispensable obtener una llave para la API a través de alguno de los administradores de la organización a la que pertenecemos.

La creación e integración de llaves se realiza a través del [panel principal de Onfleet](https://onfleet.com/dashboard#/manage).

Para utilizar la librería sólo tenemos que crear una instancia de `Onfleet` usando la llave:
```php
$onfleet = new Onfleet("<su_api_akey>");
```

Opcionalmente, se puede personalizar el _timeout_ para hacerlo menor que el valor por defecto de la API de Onfleet (70,000 ms) suministrando un 2do parámetro:
```php
$onfleet = new Onfleet("<su_api_akey>", 30000);
```

### Autenticación
Una vez tenemos la instancia de `Onfleet` podemos probar el endpoint de autenticación:
```php
$onfleet->verifyKey();  // Returns a boolean
```

### Pruebas unitarias
`composer run-script test`

### Límites
La API impone un límite de 20 peticiones por segundo entre todas las peticiones de todas las llaves de la organización. Más detalles [aquí](https://docs.onfleet.com/reference#throttling).

La librería también implementa un limitador para prevenir excesos accidentales de los límites y, eventualmente, posibles sanciones.

### Operaciones CRUD soportadas
Estas son las operaciones disponibles para cada endpoint:

| Entity | GET | POST | PUT | DELETE |
| :-: | :-: | :-: | :-: | :-: |
| [Admins/Administrators](https://docs.onfleet.com/reference#administrators) | get() | create(obj), matchMetadata(obj) | update(id, obj) | deleteOne(id) |
| [Containers](https://docs.onfleet.com/reference#containers) | get(id, 'workers'), get(id, 'teams'), get(id, 'organizations') | x | update(id, obj) | x |
| [Destinations](https://docs.onfleet.com/reference#destinations) | get(id) | create(obj), matchMetadata(obj) | x | x |
| [Hubs](https://docs.onfleet.com/reference#hubs) | get() | create(obj) | update(id, obj) | x |
| [Organization](https://docs.onfleet.com/reference#organizations) | get(), get(id) | x | insertTask(id, obj) | x |
| [Recipients](https://docs.onfleet.com/reference#recipients) | get(id), get(name, 'name'), get(phone, 'phone') | create(obj), matchMetadata(obj) | update(id, obj) | x |
| [Tasks](https://docs.onfleet.com/reference#tasks) | get(query), get(id), get(shortId, 'shortId') | create(obj), clone(id), forceComplete(id), batch(obj), autoAssign(obj), matchMetadata(obj) | update(id, obj) | deleteOne(id) |
| [Teams](https://docs.onfleet.com/reference#teams) | get(), get(id), getWorkerEta(id, obj) | create(obj), autoDispatch(id, obj) | update(id, obj), insertTask(id, obj) | deleteOne(id) |
| [Webhooks](https://docs.onfleet.com/reference#webhooks) | get() | create(obj) | x | deleteOne(id) |
| [Workers](https://docs.onfleet.com/reference#workers) | get(), get(query), get(id), getByLocation(obj), getSchedule(id) | create(obj), setSchedule(id, obj), matchMetadata(obj) | update(id, obj), insertTask(id, obj) | deleteOne(id) |

#### Peticiones GET
Para obtener todos los elementos disponibles en un recurso, éstas llamadas retornan un `Promise` con el arreglo de los resultados:
```php
get();
```

##### Ejemplos de `get()`
```php
$onfleet->workers->get();
$onfleet->workers->get($parametros);
```

Opcionalmente, podemos utilizar un objeto JSON con parámetros de búsqueda en los recursos que lo soportan.
En la [documentación de la API](https://docs.onfleet.com/) se describe qué recursos lo permiten.
```php
$onfleet->workers->get([ "phones" => "<phone_number>" ]);

$onfleet->tasks->get([ "from" => "<from_time>", "to" => "<to_time>" ]);
```

Para obtener uno de los elementos de un endpoint, si el parámetreo opcional _paramName_ no es suministrado, la libraría buscará por ID. Si _paramName_ es suministrado, se utilizará _paramName_:
```php
get(<parameter>, <paramName> (optional), <queryParam> (optional));
```

Posibles valores de _paramName_:
- `id`
- `name`
- `phone`
- `shortId`

##### Ejemplos de `get(param)`
```php
$onfleet->workers->get("<24_digit_ID>");
$onfleet->workers->get("<24_digit_ID>", [ "analytics" => true ]);

$onfleet->tasks->get("<shortId>", "shortId");

$onfleet->recipients->get("<phone_number>", "phone");
$onfleet->recipients->get("<recipient_name>", "name");
$onfleet->recipients->get("<recipient_name>", "name", [ "skipPhoneNumberValidation" => true ]);


$onfleet->containers->get("<24_digit_ID>", "workers");
$onfleet->containers->get("<24_digit_ID>", "teams");
$onfleet->containers->get("<24_digit_ID>", "organizations");
```

Para obtener un driver según su ubicación, podemos utilizar la función `getByLocation`:
```php
getByLocation($parametros);
```

##### Ejemplos de `getByLocation`
```php
$parametrosLocacion = [
  "longitude" => -122.404,
  "latitude" => 37.789,
  "radius" => 10000,
];

$onfleet->workers->getByLocation($parametrosLocacion);
```

#### Peticiones POST
Para crear un elemento de un recurso:
```php
create($datos);
```

##### Ejemplos de `create()`
```php
$datos = [
  "name" => "John Driver",
  "phone" => "+16173428853",
  "teams" => ["<team_ID>", "<team_ID> (optional)", ...],
  "vehicle" => [
    "type" => "CAR",
    "description" => "Tesla Model 3",
    "licensePlate" => "FKNS9A",
    "color" => "purple",
  ],
];

$onfleet->workers->create($datos);
```

Otras peticiones POST incluyen `clone`, `forceComplete`, `batchCreate`, `autoAssign` en el recurso *Tasks*; `setSchedule` en el recurso *Workers*; `autoDispatch` en el recurso *Teams*; y `matchMetadata` en todos los recursos que lo soportan. Por ejemplo:

```php
$onfleet->tasks->clone('<24_digit_ID>');
$onfleet->tasks->forceComplete('<24_digit_ID>', $datos);
$onfleet->tasks->batchCreate($datos);
$onfleet->tasks->autoAssign($datos);

$onfleet->workers->setSchedule('<24_digit_ID>', $datos);

$onfleet->teams->autoDispatch('<24_digit_ID>', $datos);

$onfleet-><entity_name_pluralized>->matchMetadata($datos);
```

Para más información, podemos consultar la documentación sobre [`clone`](https://docs.onfleet.com/reference#clone-task), [`forceComplete`](https://docs.onfleet.com/reference#complete-task), [`batchCreate`](https://docs.onfleet.com/reference#create-tasks-in-batch), [`autoAssign`](https://docs.onfleet.com/reference#automatically-assign-list-of-tasks), [`setSchedule`](https://docs.onfleet.com/reference#set-workers-schedule). [`matchMetadata`](https://docs.onfleet.com/reference#querying-by-metadata) y [`autoDispatch`](https://docs.onfleet.com/reference#team-auto-dispatch).

#### Peticiones PUT
Para modificar un elemento de un recurso:
```php
update("<24_digit_ID>", $datos);
```

##### Ejemplos de `update()`
```php
$nuevosDatos = [
  "name" => "Jack Driver",
];

$onfleet->workers->update("<24_digit_ID>", $nuevosDatos);
```

##### Ejemplos de `insertTask()`
```php
$onfleet->workers->insertTask("<24_digit_ID>", $datos);
```

#### Peticiones DELETE
Para eliminar un elemento de un recurso:
```php
deleteOne("<24_digit_ID>");
```

##### Ejemplos de `deleteOne()`
```php
$onfleet->workers->deleteOne("<24_digit_ID>");
```

### Ejemplos de cómo utilizar las operaciones CRUD

- Obetener todos los recipients:
  ```php
  try {
    $tasks = $onfleet->tasks->get([ "from" =>"1557936000000", "to" => "1558022400000" });
    foreach ($tasks['tasks'] as $task) {
      if (is_set($task['recipients'][0])) {
        // Do something with the recipients
      }
    }
  } catch (Exception $error) {
    // Do something with the error
  }
  ```

### Qué NO hacer

- Patrón ineficiente, debemos usar metadata:
  ```php
  try {
    $workers = $onfleet->workers.get();
    for ($workers as $worker) {
      foreach ($worker['metadata'] as $metadataEntry) {
        if ($metadataEntry['name'] === "hasFreezer" && $metadataEntry['value']) {
          // Do something
        }
      }
    }
  } catch (Exception $error) {
    // Do something with the error
  }

  // DO
  try {
    $workers = $onfleet->workers->matchMetadata([["name" => "hasFreezer", "type" => "boolean", "value" => true]]);
    for ($workers as $worker) {
      // Do something
    }
  } catch (Exception $error) {
    // Do something with the error
  }
  ```

*Ir al [inicio](#onfleet-php-wrapper)*.
