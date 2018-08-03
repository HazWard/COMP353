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
