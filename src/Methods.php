<?php

namespace Onfleet;

use Onfleet\errors\RateLimitError;
use Onfleet\errors\PermissionError;
use Onfleet\errors\ServiceError;
use Onfleet\errors\HttpError;

class Methods
{
	/**
	 * Check if the string given is base 64 encoded
	 * @param string $str String to be checked
	 * @return boolean Whether the string is base 64 encoded
	 */
	public static function isBase64Encoded(string $str): bool
	{
		return (strlen($str) === 24 && preg_match('/^[a-zA-Z\d*~]{24}/', $str));
	}

	/**
	 * Replace params in the URL for an endpoint
	 * @param string $url Onfleet API
	 * @param string $id ID to be replaced in the URL
	 * @return string URL with params replaced
	 */
	public static function replaceWithId(string $url, string $id): string
	{
		return preg_replace('/:[a-z]*Id/', $id, $url);
	}

	/**
	 * Replace params in the URL for an endpoint
	 * @param string $url Onfleet API
	 * @param string $endpoint Endpoint to be consumed
	 * @param string $id ID to be replaced in the URL
	 * @return string URL with params replaced
	 */
	public static function replaceWithEndpointAndParam(string $url, string $endpoint, string $id): string
	{
		$path = $url;
		if (in_array($endpoint, ['workers', 'teams', 'organizations'])) {
			$path = preg_replace('/\/:param/', "", $url);
		}
		return preg_replace('/:[a-z]*Id$/', "{$endpoint}/{$id}", $path);
	}

	/**
	 * Executes a method called from a resource
	 * @param array $methodData Method data to be executed calling the API
	 * @param Onfleet $api Onfleet API configuration
	 * @param array $args Extra params provided to the method
	 * @return array Onfleet API response
	 * @throws RateLimitError Request exceed the max time allowed
	 * @throws PermissionError User is not allowed to consume the method
	 * @throws ServiceError Something happened consuming the API method
	 * @throws HttpError Something happened consuming the API
	 */
	public static function method(array $methodData, Onfleet $api, ...$args)
	{
		$method = $methodData['method'] ?? 'get';
		$path = $methodData['path'] ?? '';
		$altPath = $methodData['altPath'] ?? [];
		$queryParams = $methodData['queryParams'] ?? [];
		$deliveryManifestObject = $methodData['deliveryManifestObject'] ?? [];
		$timeoutInMilliseconds = $methodData['timeoutInMilliseconds'] ?? 0;

		$url = "{$api->api->baseUrl}{$path}";
		$body = "";
		$hasBody = false;

		// No arguments
		if (count($args) === 0 && $method === 'GET' && !empty($altPath)) {
			$url = "{$api->api->baseUrl}{$altPath}";
		}

		// 1 or more arguments
		if (count($args) >= 1 && in_array($method, ['GET', 'DELETE', 'PUT'])) {
			// If the 2nd argument is part of this array, this is a new endpoint
			// This covers get(id, params) and insertTask(id, params)
			if (isset($args[1]) && in_array($args[1], ['name', 'shortId', 'phone', 'workers', 'organizations', 'teams'])) {
				$url = self::replaceWithEndpointAndParam($url, $args[1], $args[0]);
				// If the 1st argument is a base 64 encoded ID, replaces URL path with ID
				// This covers get(id), update(id), and deleteOne(id)
			} else if (is_string($args[0]) && self::isBase64Encoded($args[0])) {
				$url = self::replaceWithId($url, $args[0]);
				// Else, use the alternate path
				// This covers get() with no parameters passed in
			} else {
				$url = "{$api->api->baseUrl}{$altPath}";
			}
			// PUT Prep covering update(id, body)
			// Second argument should be the body of the request, first arg is ID
			if ($method === 'PUT') {
				$body = $args[1];
				$hasBody = true;
			}
		}

		// POST Prep - 3 different cases
		if ($method === 'POST') {
			if (is_string($args[0]) && self::isBase64Encoded($args[0])) { // forceComplete, clone, and autoDispatch (with ID)
				$url = self::replaceWithId($url, $args[0]);
				if ($args[1]) { // forceComplete and autoDispatch (with ID, has body)
					$body = $args[1];
					$hasBody = true;
				}
			} else { // create, batchCreate, matchMetadata, and autoAssign (no ID, has body)
				$body = $args[0];
				$hasBody = true;
			}
		}

		// Query Params extension
		if ($queryParams === true) {
			$httpQueryParams = '';
			foreach ($args as $element) {
				if (is_array($element) || is_object($element)) {
					$httpQueryParams .= (empty($httpQueryParams) ? '?' : '&') . http_build_query($element);
				}
			}
			$url = "{$url}{$httpQueryParams}";
		}

		// Reference https://docs.onfleet.com/reference/delivery-manifest
		if ($deliveryManifestObject && isset($args[0]) && count($args) > 0) {
			foreach ($args as $item) {
				if (isset($item['hubId']) && isset($item['workerId'])) {
					$body = array(
						'path' => 'providers/manifest/generate?hubId=' . $item['hubId'] . '&workerId=' . $item['workerId'],
						'method' => "GET"
					);
					$hasBody = true;
				}
				if (isset($item['googleApiKey'])) {
					$api->api->headers["X-API-Key"] = 'Google ' . $item['googleApiKey'];
				}
				$queryParams = [];
				if (isset($item['startDate'])) {
					$queryParams['startDate'] = $item['startDate'];
				}
				if (isset($item['endDate'])) {
					$queryParams['endDate'] = $item['endDate'];
				}
				if (!empty($queryParams)) {
					$url .= '?' . http_build_query($queryParams);
				}
			}
		}
		

		$result = $api->api->client->execute($url, $method, $api->api->headers, ($hasBody ? $body : []), $timeoutInMilliseconds);

		if ($result['success']) return $method === 'DELETE' ? $result["code"] : $result['data'];

		$errorCode = $result['error']['message']['error'];
		$errorInfo = [
			$result['error']['message']['message'],
			$result['error']['message']['cause'],
			$errorCode,
			$result['error']['message']['request'],
		];

		if ($errorCode === 2300) {
			throw new RateLimitError($errorInfo[0], $errorInfo[1] ?? '', $errorInfo[2], $errorInfo[3]);
		} else if ($errorCode <= 1108 && $errorCode >= 1100) {
			throw new PermissionError($errorInfo[0], $errorInfo[1] ?? '', $errorInfo[2], $errorInfo[3]);
		} else if ($errorCode >= 2500) {
			throw new ServiceError($errorInfo[0], $errorInfo[1] ?? '', $errorInfo[2], $errorInfo[3]);
		} else if ($errorCode === 2218) { // Precondition error for Auto-Dispatch
			throw new ServiceError($errorInfo[0], $errorInfo[1] ?? '', $errorInfo[2], $errorInfo[3]);
		}
		// All others, throw general HTTP error
		throw new HttpError($errorInfo[0], $errorInfo[1] ?? '', $errorInfo[2], $errorInfo[3]);
	}
}
