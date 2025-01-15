<?php

namespace Onfleet\resources;

class Batch extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/tasks/batch'],
			'get' => ['method' => 'GET', 'path' => '/tasks/batch/:jobId'],
			'createAsync' => ['method' => 'POST', 'path' => '/tasks/batch-async']
		]);
	}
}
