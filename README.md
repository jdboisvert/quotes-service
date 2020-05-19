# React/Laravel quotes service

A simple application used to maintain a database of quotes.

## Technology used

-   Frontend: React JS
-   Backend: Laravel

## After cloning project

1. Run the 'composer install' command (it is possible you will have issues so run 'composer update' but be careful running this command)
2. Run the following command to generate a .env file: cp .env.example .env
3. You can specify your database information, or to get up and running quickly add a file named 'database.sqlite' inside the /database directory
4. Generate the needed app key: php artisan key:generate
5. Run migrations and seed the database: php artisan migrate:refresh --seed (if you wish to remigrate and reseed run php artisan migrate:refresh --seed)
6. Run 'npm install'
   [Source for more details ](https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/)

## Running project

1. First start up Laravel backend via 'php artisan serve --port=8080'
2. Build and compile the react project with 'npm run dev'
3. Visit http://localhost:8080/ and if everything is working correctly you should be brought to the main page listing all the quotes in the database

## Run Laravel unit tests

-   php artisan test

## Quotes REST API details

The API supports the following requests:

-   Create quote

    -   Method: POST
    -   URL: /api/quote
    -   Parameters:
        -   quote: Quote in quection (ex: 'Live life')(required)
        -   author_name: Person who the quote belongs to (ex: 'Morgan Freeman') (required)
    -   Responses:
        -   201: Quote created successfully
            -   quote: holding values of the quote
        -   409: Error registering quote

-   Get a list of all the quotes

    -   Method: GET
    -   URL: /api/quotes
    -   Responses:
        -   200: Get all quotes successfully
            -   quotes: holding an array of all the quotes
        -   500: Error getting quotes

-   Read details of a quote

    -   Method: GET
    -   URL: /api/quote/details/{id}
    -   {id}: The id of the quote in question
    -   Responses:
        -   200: Got quote successfully
            -   quote: holding details of the quote
        -   404: Quote does not exist
        -   500: Error getting quote

-   Update details of a quote connection

    -   Method: PUT
    -   URL: /api/quote/update/{id}
    -   {id}: The id of the quote in question
    -   Parameters:
        -   quote: Quote in quection (ex: 'Live life')(required if author_name not given)
        -   author_name: Person who the quote belongs to (ex: 'Morgan Freeman') (required if quote not given)
    -   Responses:
        -   200: Quote updated successfully
            -   quote: holding details of the quote now updated
        -   404: Quote does not exist
        -   409: Error updatting quote

-   Delete a quote connection
    -   Method: DELETE
    -   URL: /api/quote/delete/{id}
    -   {id}: The id of the quote in question
    -   Responses:
        -   200: Quote deleted successfully
        -   404: Quote does not exist
        -   500: Error deleting quote
