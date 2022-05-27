<?php

return [
	"TEST_DATA" => [
		"DATA" => [

			"apiKey" => 'a98b7123a973e8c903612e63c8c31a64',
			"encodedApiKey" => 'YTk4YjcxMjNhOTczZThjOTAzNjEyZTYzYzhjMzFhNjQ=',
			"baseUrl" => 'https://onfleet.com/api/v2/admins',
			"url" => 'https://onfleet.com/api/v2/admins/:adminId',
			"id" => '7p5Xl5HD1yG~xFqtIselXJjT',
			"phone" => '234564839',
			"pathById" => 'https://onfleet.com/api/v2/admins/7p5Xl5HD1yG~xFqtIselXJjT',
			"pathWithEndpoint" => 'https://onfleet.com/api/v2/admins/phone/234564839',
			"parameters" => [
				"phone" => '4055157789',
				"state" => '0',
			],
			"pathWithQuery" => 'https://onfleet.com/api/v2/admins?phone=4055157789&state=0',
			"auth" => [
				"message" => "Hello organization 'BxvqsKQBEeKGMeAsN09ScrVt' hitting Onfleet from 104.248.209.194",
				"status" => 200,
			],
			"list" => [
				[
					"id" => '4d86V7CHSsHzjCbXeakj6gXp',
					"organization" => 'BxvqsKQBEeKGMeAsN09ScrVt',
					"email" => 'james@onfleet.com',
					"type" => 'super',
					"name" => 'Onfleet Admin',
					"isActive" => true,
					"phone" => '+18881881788',
				],
				[
					"id" => 'hLedWP10pCKvDu7RIe2TfX~Q',
					"organization" => 'BxvqsKQBEeKGMeAsN09ScrVt',
					"email" => 'wrapper@onfleet.com',
					"type" => 'standard',
					"name" => 'Onfleet wrapper',
					"isActive" => false,
					"phone" => '+18881881789',
				],
			],
			"get" => [
				"id" => 'SxD9Ran6pOfnUDgfTecTsgXd',
				"organization" => 'BxvqsKQBEeKGMeAsN09ScrVt',
				"shortId" => '44a56188',
				"trackingURL" => 'https://onf.lt/44a56188',
				"worker" => 'Mdfs*NDZ1*lMU0abFXAT82lM',
				"merchant" => 'BxvqsKQBEeKGMeAsN09ScrVt',
				"executor" => 'BxvqsKQBEeKGMeAsN09ScrVt',
				"pickupTask" => false,
				"notes" => 'Onfleet API Wrappers!',
				"completionDetails" => [
					"events" => [
						[
							"name" => 'start',
							"time" => 1555093046456,
						],
					],
					"failureReason" => 'NONE',
					"success" => true,
				],
				"destination" => [
					"id" => '9qcJpfoqLwDppaZO8wYPFfsT',
					"timeCreated" => 1552586211000,
					"timeLastModified" => 1552586211499,
					"location" => [
						"-121.79274459999999",
						"37.7020352",
					],
					"address" => [
						"apartment" => '',
						"state" => 'California',
						"postalCode" => '94103',
						"country" => 'United States',
						"city" => 'San Francisco',
						"street" => 'Market St',
						"number" => '929',
					],
				],
			],
			"getRecipients" => [
				"id" => '9SY28MU8PYaPP9Iq10bcpBdL',
				"organization" => 'BxvqsKQBEeKGMeAsN09ScrVt',
				"name" => 'Onfleet Rocks',
				"phone" => '+18881787788',
				"skipSMSNotifications" => false,
			],
			"createTeams" => [
				"id" => 'FFqPs1KHayxorfA~~xIj0us4',
				"name" => 'Onfleet Team',
				"workers" => [
					'1LjhGUWdxFbvdsTAAXs0TFos',
					'F8WPCqGmQYWpCkQ2c8zJTCpW',
				],
				"managers" => [
					'Mrq7aKqzPFKX22pmjdLx*ohM',
				],
				"hub" => 'tKxSfU7psqDQEBVn5e2VQ~*O',
			],
			"getWorkerEta" => [
				"workerId" => '56BsmZRWAKgGGG9g0xDczl6u',
				"vehicle" => 'CAR',
				"steps" => [
					[
						"location" => ["101.5929671", "3.1484824"],
						"travelTime" => 1738,
						"distance" => 21333,
						"serviceTime" => 120,
						"arrivalTime" => 1621339297,
						"completionTime" => 1621341129,
					],
					[
						"location" => ["101.627378", "3.1403995"],
						"travelTime" => 645,
						"distance" => 6348,
						"serviceTime" => 120,
						"arrivalTime" => 1621341774,
						"completionTime" => 1621341894,
					],
				],
			],
			"forceComplete" => [
				"status" => 200,
				"completionDetails" => [
					"notes" => 'Forced complete by Onfleet Wrapper',
				],
			],
			"updateWorkers" => [
				"id" => 'Mdfs*NDZ1*lMU0abFXAT82lM',
				"organization" => 'BxvqsKQBEeKGMeAsN09ScrVt',
				"name" => 'Stephen Curry',
				"displayName" => 'SC30',
				"phone" => '+18883033030',
				"activeTask" => null,
				"tasks" => [
					'ybB97MGXhGoAAKrUAlyywmBN',
				],
				"onDuty" => false,
				"accountStatus" => 'ACCEPTED',
				"teams" => [
					'W*8bF5jY11Rk05E0bXBHiGg2',
				],
				"vehicle" => [
					"id" => 'fMuHImeUFAk3uv1O*GaXX5Zl',
					"type" => 'CAR',
					"description" => null,
					"licensePlate" => null,
					"color" => null,
				],
				"addresses" => [
					"routing" => null,
				],
			],
			"delete" => 200,
			"listWebhooks" => [
				[
					"id" => "ZnVRY8rdfUwNPjHQy2QthtxZ",
					"name" => "Webhook 1 - Driver Nearby",
					"count" => 7,
					"url" => "https://11ec4a02.ngrok.com/onfleet/driverNearby",
					"trigger" => 2,
					"isEnabled" => true
				],
				[
					"id" => "9zqMxI79mRcHpXE111nILiPn",
					"name" => "Webhook 2 - TaskStarted",
					"count" => 3,
					"url" => "https://11ec4a02.ngrok.com/onfleet/taskStart",
					"trigger" => 0,
					"isEnabled" => true
				],
				[
					"id" => "8KD3PcIMsG*bC0imJ~EjR9GX",
					"name" => "Webhook 3 - TaskCompleted on Zapier",
					"count" => 6,
					"url" => "https://hooks.zapier.com/hooks/catch/4212020/0z5pha/",
					"trigger" => 3,
					"isEnabled" => true
				]
			],
			"createWebhook" => [
				"id" => "9zqMxI79mRcHpXE111nILiPn",
				"count" => 0,
				"url" => "https://11ec4a02.ngrok.com/onfleet/taskStart",
				"trigger" => 2,
			],
			"getContainer" => [
				"id" => "NngUFbKT95Hly0PkFwPui*kg",
				"timeCreated" => 1518563775000,
				"timeLastModified" => 1518563775468,
				"organization" => "yAM*fDkztrT3gUcz9mNDgNOL",
				"type" => "WORKER",
				"activeTask" => null,
				"tasks" => [
					"b3F~z2sU7H*auNKkM6LoiXzP",
					"1ry863mrjoQaqMNxnrD5YvxH",
					"l33lg5WLrja3Tft*MO383Gub"
				],
				"worker" => "2Fwp6wS5wLNjDn36r1LJPscA"
			],
			"listHubs" => [
				[
					"id" => "E4s6bwGpOZp6pSU3Hz*2ngFA",
					"name" => "SF North",
					"location" => [
						-122.44002499999999,
						37.801826
					],
					"address" => [
						"number" => "3415",
						"street" => "Pierce Street",
						"city" => "San Francisco",
						"state" => "California",
						"country" => "United States",
						"postalCode" => "94123",
						"apartment" => ""
					],
					"teams" => [
						"W*8bF5jY11Rk05E0bXBHiGg2"
					]
				],
				[
					"id" => "tKxSfU7psqDQEBVn5e2VQ~*O",
					"name" => "SF South",
					"location" => [
						-122.44337999999999,
						37.70883
					],
					"address" => [
						"number" => "335",
						"street" => "Hanover Street",
						"city" => "San Francisco",
						"state" => "California",
						"country" => "United States",
						"postalCode" => "94112",
						"apartment" => ""
					],
					"teams" => [
						"W*8bF5jY11Rk05E0bXBHiGg2"
					]
				]
			],
			"createHub" => [
				"id" => "i4FoP*dTVrdnGqvIVvvA69aB",
				"name" => "VIP customer",
				"location" => [
					-117.8767457,
					33.8079071
				],
				"address" => [
					"number" => "2695",
					"street" => "East Katella Avenue",
					"city" => "Anaheim",
					"county" => "Orange County",
					"state" => "California",
					"country" => "United States",
					"postalCode" => "92806",
					"apartment" => "",
					"name" => "VIP customer"
				],
				"teams" => [
					"kq5MFBzYNWhp1rumJEfGUTqS"
				]
			],
			"updateHub" => [
				"id" => "i4FoP*dTVrdnGqvIVvvA69aB",
				"name" => "VIP customer hub",
				"location" => [
					-117.8767457,
					33.8079071
				],
				"address" => [
					"number" => "2695",
					"street" => "East Katella Avenue",
					"city" => "Anaheim",
					"county" => "Orange County",
					"state" => "California",
					"country" => "United States",
					"postalCode" => "92806",
					"apartment" => "",
					"name" => "VIP customer"
				],
				"teams" => [
					"kq5MFBzYNWhp1rumJEfGUTqS"
				]
			],
			"organization" => [
				"id" => "yAM*fDkztrT3gUcz9mNDgNOL",
				"timeCreated" => 1454634415000,
				"timeLastModified" => 1455048510514,
				"name" => "Onfleet Fine Eateries",
				"email" => "fe@onfleet.com",
				"image" => "5cc28fc91d7bc5846c6ce9c1",
				"timezone" => "America/Los_Angeles",
				"country" => "US",
				"delegatees" => [
					"cBrUjKvQQgdRp~s1qvQNLpK*"
				]
			],
			"organizationDelegatee" => [
				"id" => "cBrUjKvQQgdRp~s1qvQNLpK*",
				"name" => "Onfleet Engineering",
				"email" => "dev@onfleet.com",
				"timezone" => "America/Los_Angeles",
				"country" => "US"
			],
			"getDestination" => [
				"id" => "0i~RR0SUIculbRFsIse6MENg",
				"timeCreated" => 1455156664000,
				"timeLastModified" => 1455156664697,
				"location" => [
					-122.4052935,
					37.7721234
				],
				"address" => [
					"apartment" => "",
					"state" => "California",
					"postalCode" => "94103",
					"country" => "United States",
					"city" => "San Francisco",
					"street" => "Brannan Street",
					"number" => "888"
				],
				"notes" => "",
				"metadata" => []
			],
			"createDestination" => [
				"id" => "JLn6ZoYGZWn2wB2HaR9glsqB",
				"timeCreated" => 1455156663000,
				"timeLastModified" => 1455156663896,
				"location" => [
					-122.3965731,
					37.7875728
				],
				"address" => [
					"apartment" => "5th Floor",
					"state" => "California",
					"postalCode" => "94105",
					"country" => "United States",
					"city" => "San Francisco",
					"street" => "Howard Street",
					"number" => "543"
				],
				"notes" => "Don't forget to check out the epic rooftop.",
				"metadata" => []
			],
			"listWorkers" => [
				[
					"id" => "h*wSb*apKlDkUFnuLTtjPke7",
					"timeCreated" => 1455049674000,
					"timeLastModified" => 1455156646529,
					"organization" => "yAM*fDkztrT3gUcz9mNDgNOL",
					"name" => "Andoni",
					"displayName" => "Andoni",
					"phone" => "+14155558442",
					"activeTask" => null,
					"tasks" => [
						"11z1BbsQUZFHD1XAd~emDDeK"
					],
					"onDuty" => true,
					"timeLastSeen" => 1455156644323,
					"capacity" => 0,
					"userData" => [
						"appVersion" => "1.2.0",
						"batteryLevel" => 0.99,
						"deviceDescription" => "Simulator (iOS 12.1.0)",
						"platform" => "IOS"
					],
					"accountStatus" => "ACCEPTED",
					"metadata" => [
						[
							"name" => "nickname",
							"type" => "string",
							"value" => "Puffy",
							"visibility" => [
								"api"
							]
						],
						[
							"name" => "otherDetails",
							"type" => "object",
							"value" => [
								"availability" => [
									"mon" => "10:00",
									"sat" => "16:20",
									"wed" => "13:30"
								],
								"premiumInsurance" => false,
								"trunkSize" => 9.5
							],
							"visibility" => [
								"api"
							]
						]
					],
					"imageUrl" => null,
					"teams" => [
						"R4P7jhuzaIZ4cHHZE1ghmTtB"
					],
					"delayTime" => null,
					"location" => [
						-122.4015496466794,
						37.77629837661284
					],
					"vehicle" => null
				],
				[
					"id" => "1LjhGUWdxFbvdsTAAXs0TFos",
					"timeCreated" => 1455049755000,
					"timeLastModified" => 1455072352267,
					"organization" => "yAM*fDkztrT3gUcz9mNDgNOL",
					"name" => "Yevgeny",
					"displayName" => "YV",
					"phone" => "+14155552299",
					"activeTask" => null,
					"tasks" => [
						"*0tnJcly~vSI~9uHz*ICHXTw",
						"PauBfRH8gQCjtMLaPe97G8Jf"
					],
					"onDuty" => true,
					"timeLastSeen" => 1455156649007,
					"capacity" => 0,
					"userData" => [
						"appVersion" => "1.2.0",
						"batteryLevel" => 0.97,
						"deviceDescription" => "Galaxy S8",
						"platform" => "Android"
					],
					"accountStatus" => "ACCEPTED",
					"metadata" => [],
					"location" => [
						-122.4016366,
						37.7764098
					],
					"imageUrl" => null,
					"teams" => [
						"9dyuPqHt6kDK5JKHFhE0xihh",
						"yKpCnWprM1Rvp3NGGlVa5TMa",
						"fwflFNVvrK~4t0m5hKFIxBUl"
					],
					"delayTime" => null,
					"vehicle" => [
						"id" => "ArBoHNxS4B76AiBKoIawY9OS",
						"type" => "CAR",
						"description" => "Lada Niva",
						"licensePlate" => "23KJ129",
						"color" => "Red",
						"timeLastModified" => 1545086815176
					]
				]
			],
			"getWorker" => [
				"id" => "1LjhGUWdxFbvdsTAAXs0TFos",
				"timeCreated" => 1455049755000,
				"timeLastModified" => 1455072352267,
				"organization" => "yAM*fDkztrT3gUcz9mNDgNOL",
				"name" => "Yevgeny",
				"phone" => "+14155552299",
				"activeTask" => null,
				"tasks" => [
					"*0tnJcly~vSI~9uHz*ICHXTw",
					"PauBfRH8gQCjtMLaPe97G8Jf"
				],
				"onDuty" => true,
				"timeLastSeen" => 1455156649007,
				"delayTime" => null,
				"teams" => [
					"9dyuPqHt6kDK5JKHFhE0xihh",
					"yKpCnWprM1Rvp3NGGlVa5TMa",
					"fwflFNVvrK~4t0m5hKFIxBUl"
				],
				"metadata" => [],
				"location" => [
					-122.4016366,
					37.7764098
				],
				"vehicle" => [
					"id" => "ArBoHNxS4B76AiBKoIawY9OS",
					"type" => "CAR",
					"description" => "Lada Niva",
					"licensePlate" => "23KJ129",
					"color" => "Red"
				],
				"analytics" => [
					"events" => [
						[
							"action" => "onduty",
							"time" => 1455072352164
						],
						[
							"action" => "offduty",
							"time" => 1455072485603
						]
					],
					"distances" => [
						"enroute" => 0,
						"idle" => 0
					],
					"times" => [
						"enroute" => 0,
						"idle" => 132.18
					],
					"taskCounts" => [
						"succeeded" => 0,
						"failed" => 0
					]
				]
			],
			"createRecipient" => [
				"id" => "VVLx5OdKvw0dRSjT2rGOc6Y*",
				"organization" => "yAM*fDkztrT3gUcz9mNDgNOL",
				"timeCreated" => 1455156665000,
				"timeLastModified" => 1455156665390,
				"name" => "Boris Foster",
				"phone" => "+16505551133",
				"notes" => "Always orders our GSC special",
				"skipSMSNotifications" => false,
				"metadata" => []
			],
			"listAssignedTasks" => [
				"tasks" => [
					"id" => "3VtEMGudjwjjM60j7deSIY3j",
					"timeCreated" => 1643317843000,
					"timeLastModified" => 1643319602671,
					"organization" => "nYrkNP6jZMSKgBwG9qG7ci3J",
					"shortId" => "c77ff497",
					"trackingURL" => "https://onf.lt/c77ff497",
					"worker" => "ZxcnkJi~79nonYaMTQ960Mg2",
					"merchant" => "nYrkNP6jZMSKgBwG9qG7ci3J",
					"executor" => "nYrkNP6jZMSKgBwG9qG7ci3J",
					"creator" => "vjw*RDMKDljKVDve1Vtcplgu",
					"state" => 1,
					"completeAfter" => null,
					"completeBefore" => null,
					"pickupTask" => false,
					"notes" => "",
					"trackingViewed" => false,
					"recipients" => [],
					"eta" => null,
					"delayTime" => null,
					"estimatedCompletionTime" => null,
					"estimatedArrivalTime" => null,
					"dependencies" => [],
					"completionDetails" => [
						"failureNotes" => "",
						"failureReason" => "NONE",
						"events" => [],
						"actions" => [],
						"time" => null,
						"firstLocation" => [],
						"lastLocation" => [],
						"unavailableAttachments" => []
					],
					"feedback" => [],
					"metadata" => [],
					"quantity" => 0,
					"serviceTime" => 0,
					"identity" => [
						"failedScanCount" => 0,
						"checksum" => null
					],
					"appearance" => [
						"triangleColor" => null
					],
					"scanOnlyRequiredBarcodes" => false,
					"container" => [
						"type" => "WORKER",
						"worker" => "ZxcnkJi~79nonYaMTQ960Mg2"
					],
					"destination" => [
						"id" => "nk5xGuf1eQguYXg1*mIVl0Ut",
						"timeCreated" => 1643317843000,
						"timeLastModified" => 1643317843121,
						"location" => [
							-117.8764687,
							33.8078476
						],
						"address" => [
							"apartment" => "",
							"state" => "California",
							"postalCode" => "92806",
							"number" => "2695",
							"street" => "East Katella Avenue",
							"city" => "Anaheim",
							"country" => "United States",
							"name" => "Honda Center"
						],
						"notes" => "",
						"metadata" => [],
						"googlePlaceId" => "ChIJXyczhHXX3IARFVUqyhMqiqg",
						"warnings" => []
					]
				],
				"listUnassignedTasks" => [
					"tasks" => [
						"id" => "3VtEMGudjwjjM60j7deSIY3j",
						"timeCreated" => 1643317843000,
						"timeLastModified" => 1643319602671,
						"organization" => "nYrkNP6jZMSKgBwG9qG7ci3J",
						"shortId" => "c77ff497",
						"trackingURL" => "https://onf.lt/c77ff497",
						"worker" => "ZxcnkJi~79nonYaMTQ960Mg2",
						"merchant" => "nYrkNP6jZMSKgBwG9qG7ci3J",
						"executor" => "nYrkNP6jZMSKgBwG9qG7ci3J",
						"creator" => "vjw*RDMKDljKVDve1Vtcplgu",
						"state" => 1,
						"completeAfter" => null,
						"completeBefore" => null,
						"pickupTask" => false,
						"notes" => "",
						"trackingViewed" => false,
						"recipients" => [],
						"eta" => null,
						"delayTime" => null,
						"estimatedCompletionTime" => null,
						"estimatedArrivalTime" => null,
						"dependencies" => [],
						"completionDetails" => [
							"failureNotes" => "",
							"failureReason" => "NONE",
							"events" => [],
							"actions" => [],
							"time" => null,
							"firstLocation" => [],
							"lastLocation" => [],
							"unavailableAttachments" => []
						],
						"feedback" => [],
						"metadata" => [],
						"quantity" => 0,
						"serviceTime" => 0,
						"identity" => [
							"failedScanCount" => 0,
							"checksum" => null
						],
						"appearance" => [
							"triangleColor" => null
						],
						"scanOnlyRequiredBarcodes" => false,
						"container" => [
							"type" => "WORKER",
							"worker" => "ZxcnkJi~79nonYaMTQ960Mg2"
						],
						"destination" => [
							"id" => "nk5xGuf1eQguYXg1*mIVl0Ut",
							"timeCreated" => 1643317843000,
							"timeLastModified" => 1643317843121,
							"location" => [
								-117.8764687,
								33.8078476
							],
							"address" => [
								"apartment" => "",
								"state" => "California",
								"postalCode" => "92806",
								"number" => "2695",
								"street" => "East Katella Avenue",
								"city" => "Anaheim",
								"country" => "United States",
								"name" => "Honda Center"
							],
							"notes" => "",
							"metadata" => [],
							"googlePlaceId" => "ChIJXyczhHXX3IARFVUqyhMqiqg",
							"warnings" => []
						]
					]
				]
			]
		]
	]
];
