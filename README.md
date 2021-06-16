

## Estate Intel Book API Assesment



This is a short coding assignment, which implement a REST API that calls an external API service to get information about a book as well as Create, Read, Update, Delete books locally.

## Installation

- Ensure you have php installed on your machine or you are using Xampp Appache server which comes with PHP by default
- Ensure you have composer installed on your machine aswell (composer in a php dependency manager just like npm in Node )

Clone the repository `git clone <repo-url>`

After cloning, 
    
    cd estate-intel-book-api
    
After that 
    run this command to install all dependencies `composer install` 
    
## Setup 
We need to setup up a database but for us to do that we have to create a `.env` file.
Git ignores this file when files are pushed to github, so to create it 

run this comman in your terminal `cp .env.example .env`

This command will create a .env file and copy the content of .env.example to it.

**Alternatively**

You can manually create a `.env` file in the root directory and copy the content of `.env.example` into it.

## Create database
In this project I am used SQLITE therefore we are going to setup a sqlite database 
Open `.env file` that you just created and locate the `DB_CONNECTION` section of the code

edit the code as stated below or your can copy and replace

    DB_CONNECTION=sqlite
    DB_HOST=127.0.0.1
    DB_PORT=3306

    
#### Now lets create the database file 
open your terminal make make sure you are inside the application root directory/folder
then run `touch database/database.sqlite` this command will create a `database.sqlite file` inside the database directory/folder.

once that is done 

run `php artisan migrate` to migrate your database.

**Alternatively**

If the `touch command` didn't work for you, you can manually create a `database.sqlite` file in the database root folder.
you can then run your migrations.

After the migration, the application is good to go, all you have to do is run `php artisan serve` to start up you local server and test out the API using postman or any API testing tool.


## Valid API endpoints

    Getting External books by name
    GET /api/books/name?=:nameOfBook  (:nameOFbook represents that name of book varies)

    Search Local books by name or publisher or country or release_date
    GET /api/books/search?name=:nameOfBook (:nameOFbook represents that name of book can varies)
    OR
    GET /api/books/search?publisher=:publisher (:publisher represents that publisher value can varies)
    OR 
    GET /api/books/search?publisher=:country  (:country represents that country value can varies)
    OR
    GET /api/books/search?publisher=:release_date  (:release_date represents that release_date value can varies)


    Gets all locally created books from the local database
    GET /api/books

    Returns a Single book
    GET /api/books/:id

    Create a new book
    POST /api/books

    Updates a particaular book
    PUT /api/books/:id

    Delete a particular book
    DELETE /api/books/:id

