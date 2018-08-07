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
  "username" : "<username>",
  "type" : "<user type>",
  "company" : "<only present if the user is a client>"
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

#### ``/api/index.php/managers``

Returns a list of employees who are managers

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
* ``POST`` updates the given employee (using its ID), both ``category`` and ``type`` need to be sent
* ``GET`` will return a list of contracts matching the preferences set for the given employee

Returns:
```json
{
	"category": "<a category>",
	"type": "<a type>"
}
```

### Clients

#### ``/api/index.php/clients``
* ``POST`` creates new client data into the client table & credentials data (using email & password) into the user_credentials table. Used fields in the clientForm.php
* ``GET`` returns list of Client Names (company_name) sorted in alphabetical order

Returns:
```json
# POST
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

# GET
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

### Contracts
#### ``/api/index.php/contracts``
* ``POST`` : implemented but untested. Should capture all non default information about a contract in the front end


#### ``/api/index.php/contracts/{cid}/deliverables/{deliv}``

* ``cid`` corresponds to the contract ID
* ``deliv`` corresponds to the target deliverable with the following possible values:
    * ``first`` for first deliverables
    * ``second``  for second deliverables
    * ``third`` for third deliverables
    * ``fourth``  for fourth deliverables
* Only used to update the deliverables
* Use POST with simple payload

Payload:
```json
{
  "numDays" : "<number of days to complete deliverable>"
}

```

Returns:
```json
{
	"id": "1",
	"company": "Apple Inc.",
	"category": "Premium",
	"serviceType": "Cloud",
	"acv": "50000",
	"initialAmount": "10000",
	"startDate": "2017-01-19 03:14:07",
	"firstDeliverable": 4,
	"secondDeliverable": 4,
	"thirdDeliverable": 4,
	"fourthDeliverable": 3,
	"score": null,
	"manager": "10000000"
}
```

#### ``/api/index.php/contracts/{cid}/score``
* Updates satisfaction score for the contract (only supports post)

Example payload:
```json
{
	"score":"4"
}
```

Returns:
```json
{
	"id": "1",
	"company": "Apple Inc.",
	"category": "Premium",
	"serviceType": "Cloud",
	"acv": "50000",
	"initialAmount": "10000",
	"startDate": "2017-01-19 03:14:07",
	"firstDeliverable": "4",
	"secondDeliverable": "4",
	"thirdDeliverable": "5",
	"fourthDeliverable": "5",
	"score": "4",
	"manager": "10000000"
}
```

#### ``/api/index.php/managers/{mid}/scores``
* ``GET`` : shows a list of all the scores and contracts of a manager identified by their employee id ``{mid}`` as well as the average score for the manager.

Returns:
```json
{
	"contracts": [
		{
			"id": "1",
			"score": "5"
		},
		{
			"id": "3",
			"score": "5"
		},
		{
			"id": "5",
			"score": "5"
		},
		{
			"id": "7",
			"score": "5"
		},
		{
			"id": "9",
			"score": "5"
		}
	],
	"average": "5.0000"
}
```

#### ``/api/index.php/contracts/{cid}``
* ``GET`` : views contract information identified by contract id ``{cid}``
* ``POST`` : updates contract information identified by contract id ``{cid}``

Returns:
```json
{
	"id" : "42",
	"company" : "IKEA",
	"category" : "Diamond",
	"serviceType" : "Cloud",
	"acv" : "40000",
	"initialAmount" : "10000",
	"startDate" : "2017-01-19 03:14:07",
	"firstDeliverable" : null,
	"secondDeliverable" : null,
	"thirdDeliverable" : null,
	"fourthDeliverable" : null,
	"score" : null,
	"manager" : "10000009"
}
```

#### ``/api/index.php/clients/{cName}/contracts``
* ``GET`` : returns a list of all the contracts signed by a company with the company name, ``{cName}``
* NOTE : ``...`` signifies data points ommitted for the sake of conciseness
```json
[
	{
		"id": "1",
		"category": "Premium",
		"serviceType": "Cloud",
		"acv": "50000",
		"initialAmount": "10000",
		"startDate": "2017-01-19 03:14:07",
		"firstDeliverable": "4",
		"secondDeliverable": "4",
		"thirdDeliverable": "5",
		"fourthDeliverable": "5",
		"score": "5",
		"manager": "10000000"
	},
	{
		"id": "2",
		"category": "Premium",
		"serviceType": "On-premises",
		"acv": "55000",
		"initialAmount": "15000",
		"startDate": "2017-02-21 03:14:07",
		"firstDeliverable": null,
		"secondDeliverable": null,
		"thirdDeliverable": null,
		"fourthDeliverable": null,
		"score": null,
		"manager": "10000001"
	}
]
```

### Assignment
#### ``/api/index.php/employees/{eid}/preferences``
* ``GET`` : retrieves contracts that match employees ``{eid}`` preferences

GET Results:
```json
[
    {
        "contract_id": "1",
        "contract_category": "Premium",
        "type_of_service": "Cloud",
        "acv": "50000",
        "initial_amount": "10000",
        "service_start_date": "2017-01-19 03:14:07",
        "first_deliv": "4",
        "second_deliv": "4",
        "third_deliv": "4",
        "fourth_deliv": "3",
        "score": "4",
        "manager_id": "10000000",
        "company_name": "Apple Inc."
    },
    {
        "contract_id": "11",
        "contract_category": "Premium",
        "type_of_service": "Cloud",
        "acv": "60000",
        "initial_amount": "20000",
        "service_start_date": "2017-08-19 03:14:07",
        "first_deliv": null,
        "second_deliv": null,
        "third_deliv": null,
        "fourth_deliv": null,
        "score": null,
        "manager_id": "10000002",
        "company_name": "Air Canada"
    },
    {
        "contract_id": "21",
        "contract_category": "Premium",
        "type_of_service": "Cloud",
        "acv": "50000",
        "initial_amount": "10000",
        "service_start_date": "2017-01-19 03:14:07",
        "first_deliv": null,
        "second_deliv": null,
        "third_deliv": null,
        "fourth_deliv": null,
        "score": null,
        "manager_id": "10000004",
        "company_name": "Koryo"
    }
]
```

#### ``/api/index.php/employees/{eid}/contracts/{cid}``
* ``POST`` inputs number of hours worked by employee ``{eid}`` on contract ``{cid}`` since last entry (added to the amount on db); Returns post-change assigned_contracts tuple
* ``DELETE`` removes the given employee from the given contract
Result:
```json
# On POST
{
    "employee_id": "20000001",
    "contract_id": "11",
    "hours_worked": "30"
}

# On DELETE
{
  "<message or error>" : "<message content>"
}

```

#### ``/api/index.php/employees/{eid}/contracts``
* ``GET`` ouputs all assigned contract tuples of contracts assigned to employee ``{eid}``

Result:
```json
{
    "employee_id": "20000001",
    "contract_id": "11",
    "hours_worked": "30"
}
```

### Report
* All the endpoints use the ``GET`` method

#### ``/reports/highest``
* Returns a list of companies with the highest number of contracts in their respective line of business

Returns:
```json
[
	{
		"companyName": "Manulife",
		"contracts": "10",
		"lineOfBusiness": "Food"
	},
	{
		"companyName": "Essence",
		"contracts": "2",
		"lineOfBusiness": "Retail"
	},
	{
		"companyName": "Apple Inc.",
		"contracts": "7",
		"lineOfBusiness": "Tech"
	},
	{
		"companyName": "Air Canada",
		"contracts": "10",
		"lineOfBusiness": "Travel"
	}
]
```

#### ``/reports/employees/{prov}``
* Returns a list of employees working on a contract in the given province ``prov``
* ``prov`` has the be the 2-letter abbreviation of the province

Returns:
```json
[
	{
		"id": "20000017",
		"firstName": "Samantha",
		"lastName": "Ogilovich",
		"department": "UI",
		"managerId": "10000004",
		"insurancePlan": "Silver Employee Plan"
	},
	{
		"id": "20000018",
		"firstName": "Tatiana",
		"lastName": "Mann",
		"department": "UI",
		"managerId": "10000004",
		"insurancePlan": "Silver Employee Plan"
	},
	{
		"id": "20000019",
		"firstName": "Jeannette",
		"lastName": "Dore",
		"department": "UI",
		"managerId": "10000004",
		"insurancePlan": "Normal Employee Plan"
	}
]
```

#### ``/reports/contracts``
* Returns a list of contracts created in the last 10 days
* ``prov`` has the be the 2-letter abbreviation of the province

Returns:
```json
[
	{
	    "contract_id": "11",
        "contract_category": "Premium",
        "type_of_service": "Cloud",
        "acv": "60000",
        "initial_amount": "20000",
        "service_start_date": "2017-08-19 03:14:07",
        "first_deliv": null,
        "second_deliv": null,
        "third_deliv": null,
        "fourth_deliv": null,
        "score": null,
        "manager_id": "10000002",
        "company_name": "Air Canada",
    },
    {
        "contract_id": "21",
        "contract_category": "Premium",
        "type_of_service": "Cloud",
        "acv": "50000",
        "initial_amount": "10000",
        "service_start_date": "2017-01-19 03:14:07",
        "first_deliv": null,
        "second_deliv": null,
        "third_deliv": null,
        "fourth_deliv": null,
        "score": null,
        "manager_id": "10000004",
        "company_name": "Koryo"
    }
]
```

#### ``/reports/contracts/{category}``
* Returns a list of clients whose contracts have the highest satisfaction scores in that category, grouped by the cities of clients

Returns:
```json
[
	{
		"companyName": "Manulife",
		"averageScore": null,
		"province": "AB",
		"city": "Edmonton"
	},
	{
		"companyName": "Koryo",
		"averageScore": null,
		"province": "QC",
		"city": "Montreal"
	},
	{
		"companyName": "Walmart",
		"averageScore": null,
		"province": "QC",
		"city": "Quebec"
	},
	{
		"companyName": "Air Canada",
		"averageScore": null,
		"province": "ON",
		"city": "Rockland"
	},
	{
		"companyName": "Wallgreens",
		"averageScore": null,
		"province": "SK",
		"city": "Saskatoon"
	},
	{
		"companyName": "Nike",
		"averageScore": null,
		"province": "ON",
		"city": "Toronto"
	},
	{
		"companyName": "Apple Inc.",
		"averageScore": null,
		"province": "ON",
		"city": "Waterloo"
	}
]
```