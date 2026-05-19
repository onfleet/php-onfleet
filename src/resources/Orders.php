<?php

namespace Onfleet\resources;

class Orders extends Resources
{
	protected $_endpoints = [];

	public function __construct($api)
	{
		parent::__construct($api);
		$this->defineTimeout();
		$this->endpoints([
			'create' => ['method' => 'POST', 'path' => '/taskOrders'],
			'get' => ['method' => 'GET', 'path' => '/taskOrders/:orderShortId'],
			'update' => ['method' => 'PUT', 'path' => '/taskOrders/:orderShortId'],
			'cancel' => ['method' => 'POST', 'path' => '/taskOrders/cancel'],
			'clone' => ['method' => 'POST', 'path' => '/taskOrders/:orderId/clone'],
			'reject' => ['method' => 'POST', 'path' => '/taskOrders/:orderShortId/reject'],
			'quote' => ['method' => 'GET', 'path' => '/deliveryServices/quote', 'queryParams' => true],
		]);
	}
}
