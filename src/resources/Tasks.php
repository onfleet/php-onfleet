<?php

namespace Onfleet\resources;

class Tasks extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/tasks'],
			'get' => [
				'method' => 'GET', 'path' => '/tasks/:taskId', 'altPath' => '/tasks/all', 'queryParams' => true
			],
			'update' => ['method' => 'PUT', 'path' => '/tasks/:taskId'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/tasks/:taskId'],
			'clone' => ['method' => 'POST', 'path' => '/tasks/:taskId/clone'],
			'forceComplete' => ['method' => 'POST', 'path' => '/tasks/:taskId/complete'],
			'batchCreate' => ['method' => 'POST', 'path' => '/tasks/batch'],
			'autoAssign' => ['method' => 'POST', 'path' => '/tasks/autoAssign'],
			'matchMetadata' => ['method' => 'POST', 'path' => '/tasks/metadata']
		]);
	}
}
