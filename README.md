# Onfleet PHP Wrapper

[![License](https://img.shields.io/github/license/onfleet/php-onfleet)](https://github.com/onfleet/php-onfleet/blob/master/LICENSE)
[![Latest version](https://img.shields.io/packagist/v/onfleet/php-onfleet)](https://packagist.org/packages/onfleet/php-onfleet)
![Top language](https://img.shields.io/github/languages/top/onfleet/php-onfleet)
[![Downloads](https://img.shields.io/packagist/dm/onfleet/php-onfleet)](https://packagist.org/packages/onfleet/php-onfleet)

> *Read this document in another language*:
> [Español](https://github.com/onfleet/php-onfleet/blob/master/README.es.md)

Visit our blog post on the [API wrapper project](https://onfleet.com/blog/api-wrappers-explained/) to learn more about our initiatives.
If you have any questions, please reach us by submitting an issue [here](https://github.com/onfleet/php-onfleet/issues) or contact support@onfleet.com.

### Table of contents

- [Table of contents](#table-of-contents)
- [Synopsis](#synopsis)
- [Installation](#installation)
- [Requirements](#requirements)
- [Usage](#usage)
  - [Authentication](#authentication)
  - [Throttling](#throttling)
  - [Supported CRUD operations](#supported-crud-operations)
    - [GET Requests](#get-requests)
      - [Examples of `get()`](#examples-of-get)
      - [Examples of `get(param)`](#examples-of-getparam)
      - [Examples of `getByLocation`](#examples-of-getbylocation)
    - [POST Requests](#post-requests)
      - [Examples of `create()`](#examples-of-create)
    - [PUT Requests](#put-requests)
      - [Examples of `update()`](#examples-of-update)
      - [Examples of `insertTask()`](#examples-of-inserttask)
    - [DELETE Requests](#delete-requests)
      - [Examples of `deleteOne()`](#examples-of-deleteone)
  - [Examples of utilizing your CRUD operations](#examples-of-utilizing-your-crud-operations)
  - [Things NOT to do](#things-not-to-do)

## Synopsis

The Onfleet PHP library provides convenient access to the Onfleet API.

## Installation

```
composer require onfleet/php-onfleet
```

## Requirements

The Onfleet PHP library requires bcmath extension to be [installed](https://www.php.net/manual/es/bc.installation.php).

## Usage

Before using the API wrapper, you will need to obtain an API key from one of your organization's admins.

Creation and integration of API keys are performed through the [Onfleet dashboard](https://onfleet.com/dashboard#/manage).

To start utilizing the library, you simply need to create an `Onfleet` object with your API key:

```php
$onfleet = new Onfleet("<your_api_key>");
```

Optionally, you can introduce a customized timeout that is less than the default Onfleet API timeout (70,000 ms) by providing a 2nd parameter:

```php
$onfleet = new Onfleet("<your_api_key>", 30000);
```

### Authentication

Once the `Onfleet` object is created, you can test on the authentication endpoint:

```php
$onfleet->verifyKey();  // Returns a boolean
```

### Throttling

Rate limiting is enforced by the API with a threshold of 20 requests per second across all your organization's API keys. Learn more about it [here](https://docs.onfleet.com/reference#throttling).

We have also implemented a limiter on this library to avoid you from unintentionally exceeding your rate limitations and eventually be banned for.

### Supported CRUD Operations

Here are the operations available for each entity:

|                                   Entity                                   |                               GET                               |                                            POST                                            |                 PUT                  |    DELETE     |
| :------------------------------------------------------------------------: | :-------------------------------------------------------------: | :----------------------------------------------------------------------------------------: | :----------------------------------: | :-----------: |
| [Admins/Administrators](https://docs.onfleet.com/reference#administrators) |                              get()                              |                              create(obj), matchMetadata(obj)                               |           update(id, obj)            | deleteOne(id) |
|        [Containers](https://docs.onfleet.com/reference#containers)         | get(id, 'workers'), get(id, 'teams'), get(id, 'organizations')  |                                             x                                              |           update(id, obj)            |       x       |
|      [Destinations](https://docs.onfleet.com/reference#destinations)       |                             get(id)                             |                              create(obj), matchMetadata(obj)                               |                  x                   |       x       |
|              [Hubs](https://docs.onfleet.com/reference#hubs)               |                              get()                              |                                        create(obj)                                         |           update(id, obj)            |       x       |
|      [Organization](https://docs.onfleet.com/reference#organizations)      |                         get(), get(id)                          |                                             x                                              |         insertTask(id, obj)          |       x       |
|        [Recipients](https://docs.onfleet.com/reference#recipients)         |         get(id), get(name, 'name'), get(phone, 'phone')         |                              create(obj), matchMetadata(obj)                               |           update(id, obj)            |       x       |
|             [Tasks](https://docs.onfleet.com/reference#tasks)              |          get(query), get(id), get(shortId, 'shortId')           | create(obj), clone(id), forceComplete(id), batch(obj), autoAssign(obj), matchMetadata(obj) |           update(id, obj)            | deleteOne(id) |
|             [Teams](https://docs.onfleet.com/reference#teams)              |              get(), get(id), getWorkerEta(id, obj)              |                             create(obj), autoDispatch(id, obj)                             | update(id, obj), insertTask(id, obj) | deleteOne(id) |
|          [Webhooks](https://docs.onfleet.com/reference#webhooks)           |                              get()                              |                                        create(obj)                                         |                  x                   | deleteOne(id) |
|           [Workers](https://docs.onfleet.com/reference#workers)            | get(), get(query), get(id), getByLocation(obj), getSchedule(id) |                   create(obj), setSchedule(id, obj), matchMetadata(obj), getDeliveryManifest(obj)                  | update(id, obj), insertTask(id, obj) | deleteOne(id) |

#### GET Requests

To get all the documents within an endpoint, this returns an array of results:

```php
get();
```

##### Examples of `get()`

```php
$onfleet->workers->get();
$onfleet->workers->get($queryParams);
```

Optionally you can send an array of query params for some certain endpoints.
Refer back to [API documentation](https://docs.onfleet.com/) for endpoints that support query parameters.

```php
$onfleet->workers->get([ "phones" => "<phone_number>" ]);

$onfleet->tasks->get([ "from" => "<from_time>", "to" => "<to_time>" ]);
```

To get one of the documents within an endpoint, if the optional _paramName_ is not provided, the library will search by ID. If _paramName_ is provided, it will search by _paramName_:

```php
get(<parameter>, <paramName> (optional), <queryParam> (optional));
```

_paramName_ can be any of:

- `id`
- `name`
- `phone`
- `shortId`

##### Examples of `get(param)`

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

To get a driver by location, use the `getByLocation` function:

```php
getByLocation($queryParams);
```

##### Examples of `getByLocation`

```php
$locationParams = [
  "longitude" => -122.404,
  "latitude" => 37.789,
  "radius" => 10000,
];

$onfleet->workers->getByLocation($locationParams);
```

#### POST Requests

To create a document within an endpoint:

```php
create($data);
```

##### Examples of `create()`

```php
$data = [
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

$onfleet->workers->create($data);
```

##### Examples of `getDeliveryManifest()`

```php
$data = [
  "hubId" => "<hubId>", // Required
  "workerId" => "<workerId>", // Required
  "googleApiKey" => "<googleApiKey>", // Optional
  "startDate" => "<startDate>", // Optional
  "endDate" => "<endDate>" // Optional
];

$onfleet->workers->getDeliveryManifest($data);
```

Extended POST requests include `clone`, `forceComplete`, `batchCreate`, `autoAssign` on the _Tasks_ endpoint; `setSchedule` on the _Workers_ endpoint; `autoDispatch` on the _Teams_ endpoint; and `matchMetadata` on all supported entities. For instance:

```php
$onfleet->tasks->clone('<24_digit_ID>');
$onfleet->tasks->forceComplete('<24_digit_ID>', $data);
$onfleet->tasks->batchCreate($data);
$onfleet->tasks->autoAssign($data);

$onfleet->workers->setSchedule('<24_digit_ID>', $data);
$onfleet->workers->getDeliveryManifest($data);

$onfleet->teams->autoDispatch('<24_digit_ID>', $data);

$onfleet-><entity_name_pluralized>->matchMetadata($data);
```

For more details, check our documentation on [`clone`](https://docs.onfleet.com/reference#clone-task), [`forceComplete`](https://docs.onfleet.com/reference#complete-task), [`batchCreate`](https://docs.onfleet.com/reference#create-tasks-in-batch), [`autoAssign`](https://docs.onfleet.com/reference#automatically-assign-list-of-tasks), [`setSchedule`](https://docs.onfleet.com/reference#set-workers-schedule), [`matchMetadata`](https://docs.onfleet.com/reference#querying-by-metadata), [`getDeliveryManifest`](https://docs.onfleet.com/reference/delivery-manifest), and [`autoDispatch`](https://docs.onfleet.com/reference#team-auto-dispatch).

#### PUT Requests

To update a document within an endpoint:

```php
update("<24_digit_ID>", $data);
```

##### Examples of `update()`

```php
$newData = [
  "name" => "Jack Driver",
];

$onfleet->workers->update("<24_digit_ID>", $newData);
```

##### Examples of `insertTask()`

```php
$onfleet->workers->insertTask("<24_digit_ID>", $data);
```

#### DELETE Requests

To delete a document within an endpoint:

```php
deleteOne("<24_digit_ID>");
```

##### Examples of `deleteOne()`

```php
$onfleet->workers->deleteOne("<24_digit_ID>");
```

### Examples of utilizing your CRUD operations

- Get all the recipients:
  ```php
  try {
    $tasks = $onfleet->tasks->get([ "from" =>"1557936000000", "to" => "1558022400000" ]);
    foreach ($tasks['tasks'] as $task) {
      if (is_set($task['recipients'][0])) {
        // Do something with the recipients
      }
    }
  } catch (Exception $error) {
    // Do something with the error
  }
  ```

### Things NOT to do

- Inefficient pattern, use metadata instead:

  ```php
  // DONT
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

_Go to [top](#onfleet-php-wrapper)_.
