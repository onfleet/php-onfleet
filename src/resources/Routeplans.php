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
				'method' => 'GET', 'path' => '/routePlans/:routePlanId', 'altPath' => '/routePlanId', 'queryParams' => true
			],
			'update' => ['method' => 'PUT', 'path' => '/routePlans/:routePlanId'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/routePlans/:routePlanId'],
            'addTasksToRoutePlan' => ['method' => 'PUT','path'=> '/routePlans/:routePlanId/tasks']
		]);
	} 
}