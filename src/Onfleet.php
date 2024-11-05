<?php

namespace Onfleet;

use Onfleet\resources as Resources;
use Onfleet\errors\ValidationError;
use stdClass;

class Onfleet
{
	const DEFAULT_URL = 'https://onfleet.com';
	const DEFAULT_PATH = '/api';
	const DEFAULT_API_VERSION = '/v2';
	const DEFAULT_TIMEOUT = 70000;

	public stdClass $api;
	private string $_apiKey = "";

	public Resources\Administrators $admins;
	public Resources\Administrators $administrators;
	public Resources\Containers $containers;
	public Resources\Destinations $destinations;
	public Resources\Hubs $hubs;
	public Resources\Organizations $organization;
	public Resources\Recipients $recipients;
	public Resources\Tasks $tasks;
	public Resources\Teams $teams;
	public Resources\Webhooks $webhooks;
	public Resources\Workers $workers;
	public Resources\CustomFields $customFields;

	/**
	 * @throws ValidationError
	 */
	public function __construct(
		$apiKey,
		$userTimeout = self::DEFAULT_TIMEOUT,
		$baseURL = null,
		$defaultPath = self::DEFAULT_PATH,
		$defaultApiVersion = self::DEFAULT_API_VERSION
	) {
		$baseURL = $baseURL ?? self::DEFAULT_URL;
		$defaultPath = $defaultPath ?? self::DEFAULT_PATH;
		$defaultApiVersion = $defaultApiVersion ?? self::DEFAULT_API_VERSION;

		$composer = json_decode(file_get_contents(dirname(__FILE__, 2) . "/composer.json"), false);
		if (empty($apiKey)) {
			throw new ValidationError('Onfleet API key not found, please obtain an API key from your organization admin');
		}

		if ($userTimeout > self::DEFAULT_TIMEOUT) {
			throw new ValidationError('User-defined timeout has to be shorter than 70000ms');
		} else {
			$this->_apiKey = $apiKey;
			$this->api = new \stdClass();
			$this->api->baseUrl = "{$baseURL}{$defaultPath}{$defaultApiVersion}";
			$this->api->timeout = $userTimeout ?? self::DEFAULT_TIMEOUT;
			$this->api->headers = [
				"Content-Type: application/json",
				"User-Agent: {$composer->name}-" . ($composer->version ?? ''),
				"Authorization: Basic " . base64_encode($this->_apiKey),
			];
			$this->api->client = new CurlClient();
			$this->initResources();
		}
	}

	/**
	 * Init the resource classes in order to be used by the user
	 */
	public function initResources()
	{
		$this->admins = new Resources\Administrators($this);
		$this->administrators = new Resources\Administrators($this);
		$this->containers = new Resources\Containers($this);
		$this->destinations = new Resources\Destinations($this);
		$this->hubs = new Resources\Hubs($this);
		$this->organization = new Resources\Organizations($this);
		$this->recipients = new Resources\Recipients($this);
		$this->tasks = new Resources\Tasks($this);
		$this->teams = new Resources\Teams($this);
		$this->webhooks = new Resources\Webhooks($this);
		$this->workers = new Resources\Workers($this);
		$this->customFields = new Resources\CustomFields($this);
	}

	/**
	 * Utility function to authenticate the API key
	 */
	public function verifyKey()
	{
		return $this->api->client->authenticate($this->api->baseUrl, $this->_apiKey);
	}
}
