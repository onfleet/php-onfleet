<?php

namespace Onfleet;

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\StorageException;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;

require_once("Constants.php");

class CurlClient
{
	private TokenBucket $_bucket;

	/**
	 * @throws StorageException
	 */
	public function __construct()
	{
		$storage = new FileStorage(__DIR__ . "/onfleet-api.bucket");
		$rate = new Rate(MAX_CONSUME, Rate::SECOND);
		$this->_bucket = new TokenBucket(MAX_CONSUME, $rate, $storage);
		$this->_bucket->bootstrap(MAX_CONSUME);
	}

	/**
	 * Authentication checker
	 * @param string $baseUrl Onfleet API URLl
	 * @param string $key Onfleet API Key
	 * @throws StorageException
	 * @return boolean
	 */
	public function authenticate(string $baseUrl, string $key): bool
	{
		$result = $this->execute(
			"{$baseUrl}/auth/test",
			'GET',
			['Authorization: Basic ' . base64_encode("{$key}:")]
		);
		return $result['code'] == 200;
	}

	/**
	 * Calls an HTTP API and returns the data given
	 *
	 * @param string $url API URL
	 * @param string $method Method to be used in the request
	 * @param array $headers Request headers
	 * @param array $params Params to be sent
	 * @param int $timeOut Max execution time
	 * @throws StorageException
	 * @return array
	 */
	public function execute(
		string $url,
		string $method = 'GET',
		array $headers = [],
		array $params = [],
		int $timeOut = 0
	): array {
		do {
			// Delayed 40 - 200 microseconds all request in order to have some time to limit the request
			usleep(rand(MIN_DELAY_TIME, MAX_DELAY_TIME));
			$isValid = $this->_bucket->consume(1);
			if (!$isValid) {
				sleep(1);
				continue;
			}

			$this->_client = curl_init();
			curl_setopt($this->_client, CURLOPT_URL, $url);

			// Default configuration
			curl_setopt($this->_client, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($this->_client, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($this->_client, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->_client, CURLOPT_HEADER, 1);

			if (is_int($timeOut) && $timeOut > 0) {
				curl_setopt($this->_client, CURLOPT_TIMEOUT, $timeOut);
			}

			if ($headers) {
				curl_setopt($this->_client, CURLOPT_HTTPHEADER, $headers);
			}

			if ($method === 'POST') {
				curl_setopt($this->_client, CURLOPT_POST, 1);
			} else if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
				curl_setopt($this->_client, CURLOPT_CUSTOMREQUEST, $method);
			}

			if (!empty($params) && in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
				if ($params) curl_setopt($this->_client, CURLOPT_POSTFIELDS, json_encode($params));
			}

			$result = curl_exec($this->_client);
			if ($result === false) {
				throw new \Exception("Connection couldn't be established.");
			}

			$httpCode = curl_getinfo($this->_client, CURLINFO_HTTP_CODE);
			$success = ($httpCode >= 200 && $httpCode < 300);
			$header_size = curl_getinfo($this->_client, CURLINFO_HEADER_SIZE);
			$stringHeader = substr($result, 0, $header_size);
			$this->_checkRatelimitRemaining(
				array_map(function ($value) {
					return explode(": ", $value);
				}, explode("\n", $stringHeader))
			);
			$result = json_decode(substr($result, $header_size, strlen($result)), true);
			$response = [
				'success' => $success,
				'code' => curl_getinfo($this->_client, CURLINFO_HTTP_CODE),
				'data' => $success ? $result : null,
				'error' => !$success ? $result : null,
			];

			curl_close($this->_client);
			return $response;
		} while (!$isValid);
		return [];
	}

	private function _checkRatelimitRemaining($headers)
	{
		foreach ($headers as $value) {
			if ($value[0] === "x-ratelimit-remaining") {
				$remaining = (int) $value[1];
				$available = $this->_bucket->getTokens();
				if ($available > 0 && $available < $remaining) {
					$newConsume = $remaining - $available;
					$this->_bucket->consume($newConsume);
				}
			}
		}
	}
}
