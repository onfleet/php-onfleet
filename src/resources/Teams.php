<?php

namespace Onfleet\resources;

class Teams extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/teams'],
			'get' => ['method' => 'GET', 'path' => '/teams/:teamId', 'altPath' => '/teams'],
			'update' => ['method' => 'PUT', 'path' => '/teams/:teamId'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/teams/:teamId'],
			'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/teams/:teamId'],
			'autoDispatch' =>  ['method' => 'POST', 'path' => '/teams/:teamId/dispatch'],
			'getWorkerEta' => ['method' => 'GET', 'path' => '/teams/:teamId/estimate', 'queryParams' => true],
			'listUnassignedTasks' => ['method' => 'GET', 'path' => '/teams/:teamId/tasks', 'queryParams' => true]
		]);
	}
}
