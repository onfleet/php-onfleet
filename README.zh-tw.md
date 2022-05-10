# Onfleet PHP Wrapper

[![License](https://img.shields.io/github/license/onfleet/php-onfleet)](https://github.com/onfleet/php-onfleet/blob/master/LICENSE)
[![Latest version](https://img.shields.io/packagist/v/onfleet/php-onfleet)](https://packagist.org/packages/onfleet/php-onfleet)
![Top language](https://img.shields.io/github/languages/top/onfleet/php-onfleet)
[![Downloads](https://img.shields.io/packagist/dm/onfleet/php-onfleet)](https://packagist.org/packages/onfleet/php-onfleet)

> *其他語言版本*:
> [English](https://github.com/onfleet/php-onfleet/blob/master/README.md)
> [Español](https://github.com/onfleet/php-onfleet/blob/master/README.es.md)

欲了解本開源專案的背景，請參閱[我們的部落格](https://onfleet.com/blog/api-wrappers-explained/)，如果對於Onfleet應用程式介面或是我們產品有任何的問題，歡迎[在此留言](https://github.com/onfleet/php-onfleet/issues)或直接聯繫 support@onfleet.com。


### 目錄

+ [目錄](#目錄)
* [概要](#概要)
* [安裝](#安裝)
* [使用需求](#使用需求)
* [使用守則](#使用守則)
    - [金鑰認證](#金鑰認證)
    - [單元測試](#單元測試)
    - [API速限](#api速限)
    - [請求回應](#請求回應)
    - [支援的CRUD操作](#支援的CRUD操作)
        * [GET 請求](#GET-請求)
            - [使用`get`展示所有資源的範例](#使用get展示所有資源的範例)
            - [使用`get`展示指定資源的範例](#使用get展示指定資源的範例)
            - [展示指定地理位置的`getByLocation`資源範例](#展示指定地理位置的getbylocation資源範例)
        * [POST 請求](#POST-請求)
            - [使用`create`提交指定資源的範例](#使用create提交指定資源的範例)
        * [PUT 請求](#PUT-請求)
            - [使用`update`取代指定資源的範例](#使用update取代指定資源的範例)
            - [使用`insertTask`取代指定資源的範例](#使用inserttask取代指定資源的範例)
        * [DELETE 請求](#DELETE-請求)
            - [使用`deleteOne`刪除指定資源的範例](#使用deleteone刪除指定資源的範例)
    - [利用CRUD操作的範例](#利用CRUD操作的範例)
    - [錯誤的示範](#錯誤的示範)

## 概要
`php-onfleet` 提供一個快速又便捷的方式，以獲取Onfleet應用程式介面內的資料。 

## 安裝
```
composer require onfleet/php-onfleet
```

## 使用需求
本開源專案在使用前，需先行安裝[bcmath的插件](https://www.php.net/manual/es/bc.installation.php).

## 使用守則
在使用Onfleet應用程式介面之前，請先索取應用程式介面金鑰。創建應用程式介面金鑰的詳情，請洽[您的Onfleet操作平台](https://onfleet.com/dashboard#/manage)。

將您的金鑰取代下面的your_api_key參數即可開始使用：

```php
$onfleet = new Onfleet("<your_api_key>");
```

此外，您可以在創立物件時，提供一個低於70000ms、客製化的逾時參數：

```php
$onfleet = new Onfleet("<your_api_key>", 30000);
```

### 金鑰認證
當Onfleet物件成功被創建，表示您的應用程式介面金鑰是符合預期的。您可以嘗試使用verifyKey函式來測試您的金鑰是否合法，authentication這個endpoint會認證您的金鑰，回應為一布林值：

```php
$onfleet->verifyKey();  // Returns a boolean
```

### API速限
原則上API的速限為每秒鐘20次請求，詳情請參考[官方文件](https://docs.onfleet.com/reference#throttling)。在此模組內我們也提供了限速，以避免您無意間超過了API請求的速限而導致帳號被禁的狀況。


### 支援的CRUD操作
下面為各endpoint所支援的函式列表：

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
|           [Workers](https://docs.onfleet.com/reference#workers)            | get(), get(query), get(id), getByLocation(obj), getSchedule(id) |                   create(obj), setSchedule(id, obj), matchMetadata(obj)                    | update(id, obj), insertTask(id, obj) | deleteOne(id) |

#### GET 請求

展示所有資源的指令如下，回應的主體為包含一陣列的物件：

```php
get();
```

##### 使用`get`展示所有資源的範例

```php
$onfleet->workers->get();
$onfleet->workers->get($queryParams);
```

部分的endpoint有支援*queryParam（查詢參數）*，詳情請參考[Onfleet官方文件](http://docs.onfleet.com)：


```php
$onfleet->workers->get([ "phones" => "<phone_number>" ]);

$onfleet->tasks->get([ "from" => "<from_time>", "to" => "<to_time>" ]);
```

展示指定資源的指令如下，指定的參數預設為24碼的物件ID，如果提供額外的*paramName（參數名稱）*以及*queryParam（查詢參數）*，則會根據參數做展示：

```php
get(<parameter>, <paramName> (optional), <queryParam> (optional));
```

*paramName*可以是:
- `id`
- `name`
- `phone`
- `shortId`

##### 使用`get`展示指定資源的範例
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

欲使用地理位置來搜尋線上的worker，請使用`getByLocation`：
```php
getByLocation($queryParams);
```

##### 展示指定地理位置的`getByLocation`資源範例
```php
$locationParams = [
  "longitude" => -122.404,
  "latitude" => 37.789,
  "radius" => 10000,
];

$onfleet->workers->getByLocation($locationParams);
```

#### POST 請求
提交某單一指定資源的指令如下:

```php
create($data);
```

##### 使用`create`提交指定資源的範例
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

其他延伸的POST請求包含了*Tasks*節點上的`clone`, `forceComplete`, `batchCreate`, `autoAssign`，*Workers*節點上的`setSchedule`，*Teams*節點上的`autoDispatch`，以及所有支持節點上的`matchMetadata`：

```php
$onfleet->tasks->clone('<24_digit_ID>');
$onfleet->tasks->forceComplete('<24_digit_ID>', $data);
$onfleet->tasks->batchCreate($data);
$onfleet->tasks->autoAssign($data);

$onfleet->workers->setSchedule('<24_digit_ID>', $data);

$onfleet->teams->autoDispatch('<24_digit_ID>', $data);

$onfleet-><entity_name_pluralized>->matchMetadata($data);
```

參考資料：[`clone`](https://docs.onfleet.com/reference#clone-task), [`forceComplete`](https://docs.onfleet.com/reference#complete-task), [`batchCreate`](https://docs.onfleet.com/reference#create-tasks-in-batch), [`autoAssign`](https://docs.onfleet.com/reference#automatically-assign-list-of-tasks), [`setSchedule`](https://docs.onfleet.com/reference#set-workers-schedule), [`matchMetadata`](https://docs.onfleet.com/reference#querying-by-metadata), 以及[`autoDispatch`](https://docs.onfleet.com/reference#team-auto-dispatch)。

#### PUT 請求
取代（更新）某單一指定資源的指令如下:

```php
update("<24_digit_ID>", $data);
```

##### 使用`update`取代指定資源的範例

```php
$newData = [
  "name" => "Jack Driver",
];

$onfleet->workers->update("<24_digit_ID>", $newData);
```

##### 使用`insertTask`取代指定資源的範例
```php
$onfleet->workers->insertTask("<24_digit_ID>", $data);
```

#### DELETE 請求
刪除某單一指定資源的指令如下:

```php
deleteOne("<24_digit_ID>");
```

##### 使用`deleteOne`刪除指定資源的範例
```php
$onfleet->workers->deleteOne("<24_digit_ID>");
```

### 利用CRUD操作的範例
- 展示所有存在的recipients:
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

### 錯誤的示範
- 效率不佳的請求模型（請求中的請求），建議使用metadata：

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

*返回[頂端](#onfleet-php-wrapper)*.
