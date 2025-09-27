<?php

namespace Onfleet\resources;

class Routeplans extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/routePlans'],
			'get' => [
				'method' => 'GET', 'path' => '/tasks/:routePlanId', 'altPath' => '/routePlanId', 'queryParams' => true
			],
			'update' => ['method' => 'PUT', 'path' => '/tasks/:routePlanId'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/tasks/:routePlanId'],
            'addTasksToRoutePlan' => ['method' => 'PUT','path'=> '/routePlans/:routePlanId/tasks']
		]);
	} 
}
