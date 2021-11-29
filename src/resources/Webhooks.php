<?php

namespace Onfleet\Resources;

class Webhooks extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['path' => '/webhooks', 'method' => 'POST'],
			'get' => ['path' => '/webhooks', 'method' => 'GET'],
			'deleteOne' => ['path' => '/webhooks/:webhookId', 'method' => 'DELETE'],
		]);
	}
}
