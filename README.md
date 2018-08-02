# COMP 353 - Team Project

## API documentation

### Locations

#### ``/api/locations/provinces``
Example:
```
GET on /api/locations/provinces
Return an array of provinces in the format: "Province Name (Abbreviation)"
```

#### ``/api/locations/cities``
* Use the query parameter ``province`` to get cities
	* Will not return values if the parameter is missing (404)

Example:
```
GET on /api/locations/cities?province=QC
Return an array of city names
```
