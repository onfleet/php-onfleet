<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Onfleet\CurlClient;
use Onfleet\Onfleet;

class OnfleetTest extends TestCase
{
	/**
	 * @dataProvider data
	 */
	public function testAuth($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('authenticate')->willReturn(true);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		self::assertTrue($onfleet->verifyKey());
	}

	/**
	 * @dataProvider data
	 */
	public function testAdministrators($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["list"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->administrators->get();
		self::assertIsArray($response);
		self::assertSame(count($response), 2);
		self::assertSame($response[0]["email"], 'james@onfleet.com');
		self::assertSame($response[0]["type"], 'super');
		self::assertSame($response[1]["email"], 'wrapper@onfleet.com');
		self::assertSame($response[1]["type"], 'standard');
	}

	/**
	 * @dataProvider data
	 */
	public function testTasks($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["get"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->get('SxD9Ran6pOfnUDgfTecTsgXd');
		self::assertIsArray($response);
		self::assertSame($response["id"], "SxD9Ran6pOfnUDgfTecTsgXd");
		self::assertSame($response["notes"], "Onfleet API Wrappers!");
	}

	/**
	 * @dataProvider data
	 */
	public function testTaskByShortId($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["get"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->get('44a56188', 'shortId');
		self::assertIsArray($response);
		self::assertSame($response["shortId"], "44a56188");
		self::assertSame($response["trackingURL"], "https://onf.lt/44a56188");
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateRecipient($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createRecipient"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->recipients->create([
			"name" => "Boris Foster",
			"phone" => "+1111111111",
			"notes" => "Always orders our GSC special",
			"skipPhoneNumberValidation" => true
		]);
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("name", $response);
		self::assertSame($response["id"], "VVLx5OdKvw0dRSjT2rGOc6Y*");
		self::assertSame($response["name"], "Boris Foster");
	}

	/**
	 * @dataProvider data
	 */
	public function testRecipientByPhoneNumber($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getRecipients"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->recipients->get('+18881787788', 'phone');
		self::assertIsArray($response);
		self::assertSame($response["phone"], "+18881787788");
		self::assertFalse($response["skipSMSNotifications"]);
	}

	/**
	 * @dataProvider data
	 */
	public function testRecipientByPhoneName($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getRecipients"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->recipients->get('Onfleet Rocks', 'name');
		self::assertIsArray($response);
		self::assertSame($response["name"], "Onfleet Rocks");
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateTeams($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createTeams"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->teams->create([
			"name" => 'Onfleet Team',
			"workers" => [
				'1LjhGUWdxFbvdsTAAXs0TFos',
				'F8WPCqGmQYWpCkQ2c8zJTCpW',
			],
			"managers" => [
				'Mrq7aKqzPFKX22pmjdLx*ohM',
			],
			"hub" => 'tKxSfU7psqDQEBVn5e2VQ~*O',
		]);
		self::assertIsArray($response);
		self::assertSame($response["name"], "Onfleet Team");
	}

	/**
	 * @dataProvider data
	 */
	public function testWorkerEta($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getWorkerEta"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->teams->getWorkerEta('SxD9Ran6pOfnUDgfTecTsgXd', [
			"dropoffLocation" => '101.627378,3.1403995',
			"pickupLocation" => '101.5929671,3.1484824',
			"pickupTime" => '1620965258',
		]);
		self::assertIsArray($response);
		self::assertSame($response["steps"][0]["arrivalTime"], 1621339297);
	}

	/**
	 * @dataProvider data
	 */
	public function testForceComplete($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["forceComplete"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->forceComplete('6Fe3qqFZ0DDwsM86zBlHJtlJ', [
			"completionDetails" => [
				"success" => true,
				"notes" => 'Forced complete by Onfleet Wrapper',
			]
		]);
		self::assertIsArray($response);
		self::assertSame($response["completionDetails"]["notes"], 'Forced complete by Onfleet Wrapper');
	}

	/**
	 * @dataProvider data
	 */
	public function testUpdateWorker($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["updateWorkers"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->update('Mdfs*NDZ1*lMU0abFXAT82lM', [
			"name" => 'Stephen Curry',
			"phone" => '+18883133131',
		]);
		self::assertIsArray($response);
		self::assertSame($response["name"], 'Stephen Curry');
		self::assertSame($response["phone"], '+18883033030');
	}

	/**
	 * @dataProvider data
	 */
	public function testGetWorker($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getWorker"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->get();
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("name", $response);
		self::assertArrayHasKey("teams", $response);
		self::assertSame($response["id"], "1LjhGUWdxFbvdsTAAXs0TFos");
		self::assertSame($response["name"], "Yevgeny");
	}

	/**
	 * @dataProvider data
	 */
	public function testListWorkers($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["listWorkers"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->get();
		self::assertIsArray($response);
		self::assertSame(count($response), 2);
	}

	/**
	 * @dataProvider data
	 */
	public function testDeleteTask($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["delete"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->deleteOne('AqzN6ZAq*qlSDJ0FzmZIMZz~');
		self::assertIsNumeric($response);
		self::assertSame($response, 200);
	}

	/**
	 * @dataProvider data
	 */
	public function testListWebhooks($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["listWebhooks"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->webhooks->get();
		self::assertIsArray($response);
		self::assertSame(count($response), 3);
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateWebhook($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createWebhook"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->webhooks->create([
			"url" => "https://11ec4a02.ngrok.com/onfleet/taskStart", "trigger" => 0
		]);
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("url", $response);
		self::assertSame($response["id"], "9zqMxI79mRcHpXE111nILiPn");
		self::assertSame($response["url"], "https://11ec4a02.ngrok.com/onfleet/taskStart");
	}

	/**
	 * @dataProvider data
	 */
	public function testDeleteWebhook($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["delete"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->webhooks->deleteOne("9zqMxI79mRcHpXE111nILiPn");
		self::assertIsNumeric($response);
		self::assertSame($response, 200);
	}

	/**
	 * @dataProvider data
	 */
	public function testGetContainer($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getContainer"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->webhooks->get("2Fwp6wS5wLNjDn36r1LJPscA", "workers");
		self::assertIsArray($response);
		self::assertArrayHasKey("type", $response);
		self::assertSame($response["type"], "WORKER");
	}

	/**
	 * @dataProvider data
	 */
	public function testListHubs($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["listHubs"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->hubs->get();
		self::assertIsArray($response);
		self::assertSame(count($response), 2);
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateHubs($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createHub"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->hubs->create(
			[
				"name" => "VIP customer",
				"address" => [
					"apartment" => "",
					"state" => "California",
					"postalCode" => "92806",
					"number" => "2695",
					"street" => "East Katella Avenue",
					"city" => "Anaheim",
					"country" => "United States",
					"name" => "VIP customer"
				],
				"teams" => ["kq5MFBzYNWhp1rumJEfGUTqS"]
			]
		);
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("name", $response);
		self::assertSame($response["name"], "VIP customer");
		self::assertSame($response["id"], "i4FoP*dTVrdnGqvIVvvA69aB");
	}

	/**
	 * @dataProvider data
	 */
	public function testUpdateHubs($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["updateHub"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->hubs->create(
			[
				"name" => "VIP customer hub",
			]
		);
		self::assertIsArray($response);
		self::assertArrayHasKey("name", $response);
		self::assertSame($response["name"], "VIP customer hub");
	}

	/**
	 * @dataProvider data
	 */
	public function testOrganization($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["organization"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->organization->get();
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("name", $response);
		self::assertSame($response["id"], "yAM*fDkztrT3gUcz9mNDgNOL");
		self::assertSame($response["name"], "Onfleet Fine Eateries");
	}

	/**
	 * @dataProvider data
	 */
	public function testOrganizationDelegatee($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["organizationDelegatee"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->organization->get("cBrUjKvQQgdRp~s1qvQNLpK*");
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("name", $response);
		self::assertArrayHasKey("email", $response);
		self::assertSame($response["id"], "cBrUjKvQQgdRp~s1qvQNLpK*");
		self::assertSame($response["name"], "Onfleet Engineering");
		self::assertSame($response["email"], "dev@onfleet.com");
	}

	/**
	 * @dataProvider data
	 */
	public function testGetDestination($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getDestination"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->destinations->get("0i~RR0SUIculbRFsIse6MENg");
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertSame($response["id"], "0i~RR0SUIculbRFsIse6MENg");
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateDestination($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createDestination"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->destinations->create([
			"address" => [
				"number" => "543",
				"street" => "Howard St",
				"apartment" => "5th Floor",
				"city" => "San Francisco",
				"state" => "CA",
				"country" => "USA"
			],
			"notes" => 'Don\'t forget to check out the epic rooftop.'
		]);
		self::assertIsArray($response);
		self::assertArrayHasKey("id", $response);
		self::assertArrayHasKey("notes", $response);
		self::assertSame($response["id"], "JLn6ZoYGZWn2wB2HaR9glsqB");
		self::assertSame($response["notes"], 'Don\'t forget to check out the epic rooftop.');
	}

	public function data()
	{
		return include("Response.php");
	}

	/**
	 * @dataProvider data
	 */
	public function testGetDeliveryManifest($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getManifestProvider"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->getDeliveryManifest([
			"hubId" => "kyfYe*wyVbqfomP2HTn5dAe1~*O",
			"workerId" => "kBUZAb7pREtRn*8wIUCpjnPu",
			"googleApiKey" => "<google_direction_api_key>",
			"startDate" => "1455072025000",
			"endDate" => "1455072025000'",
		]);
		self::assertIsArray($response);
		self::assertSame($response["manifestDate"], 1694199600000);
		self::assertSame(count($response["turnByTurn"]), 1);
	}

	/**
	 * @dataProvider data
	 */
	public function testWorkersGetTasks($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["workersTasks"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->getTasks('Mdfs*NDZ1*lMU0abFXAT82lM');
		self::assertIsArray($response);
		self::assertSame($response[0]["shortId"], 'c77ff497');
	}

	/**
	 * @dataProvider data
	 */
	public function testTeamUnassignedTasks($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["workersTasks"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->teams->getTasks('K3FXFtJj2FtaO2~H60evRrDc');
		self::assertIsArray($response);
		self::assertSame($response[0]["shortId"], 'c77ff497');
	}

	/**
	 * @dataProvider data
	 */
	public function testGetCustomFields($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["customFields"]]);
		$onfleet = new Onfleet($data["apiKey"]);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->customFields->get([
			"integration" => "shopify",
		]);
		self::assertIsArray($response);
		self::assertSame($response["fields"][0]["key"], 'test');
	}
}
