<?php

namespace Onfleet\Resources;

class Workers extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' =>  ['method' => 'POST', 'path' => '/workers'],
			'get' => [
				'method' => 'GET', 'path' => '/workers/:workerId',
				'altPath' => '/workers', 'queryParams' => true
			],
			'getByLocation' => [
				'method' => 'GET', 'path' => '/workers/location',
				'altPath' => '/workers/location', 'queryParams' => true
			],
			'update' => ['method' => 'PUT', 'path' => '/workers/:workerId'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/workers/:workerId'],
			'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/workers/:workerId'],
			'getSchedule' =>  ['method' => 'GET', 'path' => '/workers/:workerId/schedule'],
			'setSchedule' => ['method' => 'POST', 'path' => '/workers/:workerId/schedule'],
			'matchMetadata' => ['method' => 'POST', 'path' => '/workers/metadata']
		]);
	}
}
