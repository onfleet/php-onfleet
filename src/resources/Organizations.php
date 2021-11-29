<?php

namespace Onfleet\Resources;

class Organizations extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'get' => ['method' => 'GET', 'path' => '/organizations/:orgId', 'altPath' => '/organization'],
			'insertTask' =>  ['method' => 'PUT', 'path' => '/containers/organizations/:orgId'],
		]);
	}
}
