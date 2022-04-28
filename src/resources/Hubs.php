<?php

namespace Onfleet\resources;

class Hubs extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/hubs'],
			'get' => ['method' => 'GET', 'path' => '/hubs'],
			'update' => ['method' => 'PUT', 'path' => '/hubs/:hubId'],
		]);
	}
}
