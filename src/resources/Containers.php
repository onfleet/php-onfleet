<?php

namespace Onfleet\resources;

class Containers extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'get' => ['method' => 'GET', 'path' => '/containers/:param/:containerId']
		]);
	}
}
