<?php

namespace Onfleet\resources;

class CustomFields extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' =>  ['method' => 'POST', 'path' => '/customFields'],
			'get' => [
				'method' => 'GET', 'path' => '/customFields/:modelName',
				'altPath' => '/customFields/Task', 'queryParams' => true
			],
			'update' => ['method' => 'PUT', 'path' => '/customFields'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/customFields'],
		]);
	}
}
