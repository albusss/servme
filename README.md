## Hi SerVme!
 
Have a good day)

### Installation guide

* `git clone git@github.com:albusss/servme.git`
* `cd <projectName>`
* `composer install`
* `cp .env.example .env`
* `docker-compose build && docker-compose up -d`
* `docker-compose run php php artisan doctrine:migrations:migrate`

### Testing
* `docker-compose run php ./vendor/bin/phpunit tests/`

I wrote only a few tests due to the fact that I had very little time.
But i have written thousands of tests (unit, integration, function) and i can show another my projects

### Usage
*  Register a new User
```php
Request: POST /register
Body:
{
	"firstname": "name",
	"lastname": "lastname",
	"mobile": "19286577781",
	"gender": "male",
	"birthday": "06-03-2020 20:20:20",
	"email": "test@mail.com",
	"password": "12345678"
}

Response: 201 Created
```
*  Authenticate User
```php
Request: POST /login
Body:
{
	"email": "test@mail.wu",
	"password": "12345678"
}

Response: 200 OK

{
    "email": "test@mail.wu",
    "apiKey": "ZDhIT2NpSTQ0TkFVQkJISDRLV1JJQ2gwOVpTTjhIRkFaVVY5cFVqOQ=="
}
```
* Create Category
```php
Request: POST /api/v1/categories
Header: Authorization Bearer <apiToken>
Body:
{
	"name": "category1"
}

Response: 201 Created
```
* Create Todo
```php
Request: POST /api/v1/todos
Header: Authorization Bearer <apiToken>
Body:
{
	"name": "todo1",
	"deadline": "06-03-2022 20:20:20",
	"category": "category1"
}

Response: 201 Created
```
* Get Todo
```php
Request: GET /api/v1/todos/{id}
Header: Authorization Bearer <apiToken>

Response: 200 OK
{
    "id": 4,
    "name": "todo1",
    "description": null,
    "category": 3,
    "user": 1,
    "status": "new",
    "deadline": "2025-03-06T20:20:20+00:00",
    "createdAt": "2020-03-07T12:02:35+00:00",
    "updatedAt": "2020-03-07T12:02:35+00:00"
}
```
* Delete Todo
```php
Request: DELETE /api/v1/todos/{id}
Header: Authorization Bearer <apiToken>

Response: 204 No content
```
* List Todo
```php
Request: GET /api/v1/todos
Header: Authorization Bearer <apiToken>
Body:
{
    //available filters
	"category": "category1",
	"status": "new",
	"period": "all"
}

Response: 200 OK
```
* Update Todo
```php
Request: PATCH /api/v1/todos/{id}
Header: Authorization Bearer <apiToken>
Body:
{
    //available fields
	"name": "name2",
	"description": "description",
	"status": "completed",
	"deadline": "06-03-2029 20:20:20",
	"category": "category1"
}

Response: 200 OK
```

