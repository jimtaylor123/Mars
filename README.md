# MARS ROVER

Version: 1.4, Last updated: 2021-02-02
## Requirements
* PHP >= 7.3
* Composer: https://getcomposer.org/
* SQLITE for the database
* Free local port on 8000
* Browser, e.g Chrome
* API testing tool, e.g. Postman 

This application uses Laravel - you can find more information about the framework here: 

## Set up

1. Unzip file or clone from github: `git clone https://github.com/jimtaylor123/Mars`
2. Run composer install: `composer install`
3. Run set up migrations: `php artisan migrate:fresh --seed`
4. Run local server: `php artisan serve`
5. You should now be able to see the running application at http://localhost:8000

## Use 

1. Show all rovers: in your browser visit the url http://localhost:8000/rovers
2. View a particular rover: in your brownser visit the url http://localhost:8000/rovers/1
3. Create a rover: using postman send a POST request to http://localhost:8000/rover with headers Accept:application/json and raw json body, e.g. 
```json
{
    "x": 1,
    "y": -1,
    "direction": "south"
}
```
1. Update (ie. drive) a rover: using postman send a PATCH request to http://localhost:8000/rover/1 with headers Accept:application/json and raw json body, e.g. 
```json
{
    "commandString": "l bfbff"
}
```

## Tests

Run all tests using the following command: `
```bash
php artisan test
```

All tests should pass! 

