<?php

namespace Onfleet\Resources;

class Administrators extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'get' => ['method' => 'GET', 'path' => '/admins'],
			'update' => ['method' => 'PUT', 'path' => '/admins/:adminId'],
			'create' => ['method' => 'POST', 'path' => '/admins'],
			'deleteOne' => ['method' => 'DELETE', 'path' => '/admins/:adminId'],
			'matchMetadata' => ['method' => 'POST', 'path' => '/admins/metadata']
		]);
	}
}
