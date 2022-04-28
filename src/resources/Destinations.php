<?php

namespace Onfleet\resources;

class Destinations extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/destinations'],
			'get' => ['method' => 'GET', 'path' => '/destinations/:destinationId'],
			'matchMetadata' => ['method' => 'POST', 'path' => '/destinations/metadata']
		]);
	}
}
