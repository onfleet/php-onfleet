<?php

namespace Onfleet\Resources;

class Recipients extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['path' => '/recipients', 'method' => 'POST'],
			'get' => ['path' => '/recipients/:recipientId', 'method' => 'GET', 'queryParams' => true],
			'matchMetadata' => ['path' => '/recipients/metadata', 'method' => 'POST'],
			'update' => ['path' => '/recipients/:recipientId', 'method' => 'PUT'],
		]);
	}
}
