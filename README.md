# COMP 353 - Team Project

## Installation
1. Install Composer from [here](https://getcomposer.org/)
2. Run ``composer install`` inside the source folder


## API documentation

### Authentication

#### ``/api/index.php/auth/login``
* Request body has to have both a ``username`` and ``password`` field

Returns:
```json
# On Successful login (Status Code 200)
{
  "username" : "<username>"
  "type": "<user type>"
}

# On Unsuccessful login (Status Code 403)
{
  "error": "<error message>"
}
```

### Locations

#### ``/api/index.php/locations/provinces``
Example:
```
GET on /api/index.php/locations/provinces
Return an array of provinces in the format: "Province Name (Abbreviation)"
```

#### ``/api/index.php/locations/cities``
* Use the query parameter ``province`` to get cities
	* Will not return values if the parameter is missing (404)

Example:
```
GET on /api/index.php/locations/cities?province=QC
Return an array of city names
```

### Employees

#### ``/api/index.php/employees/{id}``

Returns:
```json
# On Successful call (Status Code 200)
{
	"id": "10000000",
	"firstName": "Juan",
	"lastName": "Vasquez",
	"department": "Development",
	"managerId": null,
	"insurancePlan": "Premium Employee Plan"
}

# On Unsuccessful call (Status Code 404)
{
	"error": "Employee with ID '<invalid ID>' was not found"
}
```

#### ``/api/index.php/employees?manager=<managerid>&list=<list of ids>``
* Either use ``manager`` or ``list`` (can't use both at the same time)
    * ``list`` is a comma-separated list of employee IDs
* Whenever the list returned is empty, the status code 404 is used (not found)

Returns:
```json
# Manager output
[
	{
		"id": "20000001",
		"firstName": "Iman",
		"lastName": "Oak",
		"department": "Development",
		"managerId": "10000000",
		"insurancePlan": "Silver Employee Plan"
	},
	{
		"id": "20000002",
		"firstName": "Jas",
		"lastName": "Abat",
		"department": "Development",
		"managerId": "10000000",
		"insurancePlan": "Silver Employee Plan"
	},
	{
		"id": "20000003",
		"firstName": "Imadake",
		"lastName": "Hamato",
		"department": "Development",
		"managerId": "10000000",
		"insurancePlan": "Normal Employee Plan"
	},
	{
		"id": "20000004",
		"firstName": "Limchang",
		"lastName": "Kim",
		"department": "Development",
		"managerId": "10000000",
		"insurancePlan": "Normal Employee Plan"
	}
]

# List output
[
	{
		"id": "10000000",
		"firstName": "Juan",
		"lastName": "Vasquez",
		"department": "Development",
		"managerId": null,
		"insurancePlan": "Premium Employee Plan"
	},
	{
		"id": "20000001",
		"firstName": "Iman",
		"lastName": "Oak",
		"department": "Development",
		"managerId": "10000000",
		"insurancePlan": "Silver Employee Plan"
	}
]
```

#### ``/api/index.php/employees/{id}/preferences``
* ``GET`` will return a JSON object with a field for ``category`` and ``type`` for the given employee ID
* ``POST`` updates the given employee (using its ID), both ``category`` and ``type`` need to be sent

Returns (in both cases):
```json
{
	"category": "<a category>",
	"type": "<a type>"
}
```

### Clients

#### ``/api/index.php/clients``
* ``POST`` creates new client data into the client table & credentials data (using email & password) into the user_credentials table. Used fields in the clientForm.php

Returns:
```json
{
	"name": "WolframAlpha",
	"number": "5143250692",
	"email": "wolframalpha@email.com",
	"firstName": "James",
	"lastName": "Carter",
	"middleInitial": "M",
	"city": "Quebec",
	"province": "QC",
	"lob": "Education"
}
```

#### ``/api/index.php/clients/{cName}``
* ``GET`` loads client information where ``cName`` is a valid company name
* ``POST`` updates the client information with the name ``cName`` (uses same fields as for client creation)

Result:
```json
{
	"name": "WolframAlpha",
	"number": "5143250692",
	"email": "wolframalpha@email.com",
	"firstName": "James",
	"lastName": "Carter",
	"middleInitial": "M",
	"city": "Quebec",
	"province": "QC",
	"lob": "Education"
}
```

#### ``/api/index.php/clients``
* ``GET`` returns list of Client Names (company_name) sorted in alphabetical order

Result:
```json
[
	"Air Canada",
	"Apple Inc.",
	"Digital Extremes",
	"Essence",
	"IKEA",
	"Koryo",
	"Manulife",
	"Nike",
	"Wallgreens",
	"Walmart"
]
```

### Contracts
#### ``/api/index.php/contracts/new``
* ``POST`` : implemented but untested. Should capture all non default information about a contract in the front end

#### ``/api/index.php/contracts/{cid}/deliverables/first/{numDays}``
* ``GET`` : ``{cid}`` is contract_id, ``{numDays}`` is number of days taken to complete first deliverable
#### ``/api/index.php/contracts/{cid}/deliverables/second/{numDays}``
#### ``/api/index.php/contracts/{cid}/deliverables/third/{numDays}``
#### ``/api/index.php/contracts/{cid}/deliverables/fourth/{numDays}``
* ``GET`` : ``{cid}`` is contract_id, ``{numDays}`` is number of days taken to complete second/third/fourth deliverable
* NOTE: fourth deliverable api doesn't check to make sure it is a silver category (the only category that has 4 deliverables
* Returns post-change contract info

Example:
``http://localhost:8888/api/index.php/contracts/1/deliverables/fourth/3``
Result:
```json
{
	"id":"1",
	"category":"Premium",
	"serviceType":"Cloud",
	"acv":"50000",
	"initialAmount":"10000",
	"startDate":"2017-01-19 03:14:07",
	"firstDeliverable":"4",
	"secondDeliverable":"4",
	"thirdDeliverable":"4",
	"fourthDeliverable":"3",
	"satisfactionScore":null,
	"manager_id":"10000000"
}
```

#### ``/api/index.php/contracts/update``
* ``POST`` : takes as input all aspects of the contracts and updates the contract tuple accordingly
* Weakly implemented but untested


#### ``/api/index.php/contracts/{cid}/score/{score}``
* ``GET`` : ``{cid}`` is contract_id, ``{score}`` is the input satisfaction score. Updates satisfaction score for the contract

Returns:
```json
[
	{
		"contractID":"1",
		"satisfactionScore":"4"
	}
]
```

#### ``/api/index.php/scores/{mid}``
* ``GET`` : shows a list of all the scores and contracts of a manager identified by their employee id ``{mid}`` as well as the average score for the manager.

Returns:
```json
[
	{
		"contractID":"1",
		"satisfactionScore":"4"
	},
	{
		"contractID":"3",
		"satisfactionScore":null
	},
	{
		"contractID":"5",
		"satisfactionScore":null
	},
	{
		"contractID":"7",
		"satisfactionScore":null
	},
	{
		"contractID":"9",
		"satisfactionScore":null
	},
	{
		"AVG(score)":"4.0000"
	}
]
```

#### ``/api/index.php/contracts/{cid}``
* ``GET`` : views contract information identified by contract id ``{cid}``
```json
{
	"contract_id":"5",
	"contract_category":"Silver",
	"type_of_service":"On-premises",
	"acv":"15000",
	"initial_amount":"3000",
	"service_start_date":"2017-09-19 03:14:07",
	"first_deliv":null,
	"second_deliv":null,
	"third_deliv":null,
	"fourth_deliv":null,
	"score":null,
	"manager_id":"10000000",
	"company_name":"Digital Extremes"
}
```

#### ``/api/index.php/myContracts/{cName}``
* ``GET`` : returns a list of all the contracts signed by a company with the company name, ``{cName}``
* NOTE : ``...`` signifies data points ommitted for the sake of conciseness
```json
[
	{
		"id":"1",
		"category":"Premium",
		"serviceType":"Cloud",
		"acv":"50000",
		"initialAmount":"10000",
		"startDate":"2017-01-19 03:14:07",
		"firstDeliverable":"4",
		"secondDeliverable":"4",
		"thirdDeliverable":"4",
		"fourthDeliverable":"3",
		"satisfactionScore":"4",
		"manager_id":"10000000"
	},
	{
		"id":"2",
		"category":"Premium",
		"serviceType":"On-premises",
		"acv":"55000",
		"initialAmount":"15000",
		"startDate":"2017-02-21 03:14:07",
		"firstDeliverable":null,
		"secondDeliverable":null,
		"thirdDeliverable":null,
		"fourthDeliverable":null,
		"satisfactionScore":null,
		"manager_id":"10000001"
	},
	{
		"id":"4",
		"category":"Silver",
		"serviceType":"Cloud",
		"acv":"10000",
		"initialAmount":"2000",
		"startDate":"2017-08-09 03:14:07",
		"firstDeliverable":null,
		"secondDeliverable":null,
		"thirdDeliverable":null,
		"fourthDeliverable":null,
		"satisfactionScore":null
		,"manager_id":"10000001"
	}
	...
]
```

### Assignment
#### ``/api/index.php/manager/{eid}``
* ``GET`` : loads list of contracts that match the preference of employee ``{eid}``
* NOTE : ``...`` signifies data points ommitted for the sake of conciseness

Returns:
```json
[
	{
		"contract_id":"1",
		"contract_category":"Premium",
		"type_of_service":"Cloud",
		"acv":"50000","initial_amount":"10000",
		"service_start_date":"2017-01-19 03:14:07",
		"first_deliv":"4",
		"second_deliv":"4",
		"third_deliv":"4",
		"fourth_deliv":"3",
		"score":"4",
		"manager_id":"10000000",
		"company_name":"Apple Inc."
	},
	{
		"contract_id":"11",
		"contract_category":"Premium",
		"type_of_service":"Cloud",
		"acv":"60000",
		"initial_amount":"20000",
		"service_start_date":"2017-08-19 03:14:07",
		"first_deliv":null,
		"second_deliv":null,
		"third_deliv":null,
		"fourth_deliv":null,
		"score":null,
		"manager_id":"10000002",
		"company_name":"Air Canada"
	},
	...
]
```

* ``POST`` : Assigns a contract to employee ``{eid}``; returns list of contracts assigned to employee
* IMPLEMENTED BUT UNTESTED

#### ``/api/index.php/employees/{eid}/hours/{cid}``
* ``POST`` : Updates number of hours employee `{eid}` worked on contract `{cid}`
* IMPLEMENTED BUT UNTESTED
