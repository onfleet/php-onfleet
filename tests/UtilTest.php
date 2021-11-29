<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Onfleet\Methods;

class UtilTest extends TestCase
{

	/**
	 * @dataProvider data
	 */
	public function testEncode($data)
	{
		self::assertSame(Methods::replaceWithId($data["url"], $data["id"]), $data["pathById"]);
		self::assertSame(Methods::replaceWithEndpointAndParam($data["url"], 'phone', $data["phone"]), $data["pathWithEndpoint"]);
	}

	public function data()
	{
		return include("Response.php");
	}
}
