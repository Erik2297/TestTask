## Title
stock management web app

## How to deploy the project
## simply run these commands in console

## Step 1 
*** composer install *** 
### for installing laravel dependencies manager

## Step 2
*** create new .env file from .env.example file ***

## Step 3
*** php artisan key:generate *** 
### for generating app key

## Step 4
*** php artisan db:create ***
### for creating database

## Step 5
*** php artisan migrate:refresh --seed *** 
### for creating tables and adding some data

## Step 6
*** npm install *** 
### for installing node-modules

## Step 7
*** npm run prod ***
### for creating production dependencies for project

## Step 8
*** php artisan serve *** 
### for starting laravel development server

### Ctrl+Click below to see the website.
http://127.0.0.1:8000/

## information about database construction and image of ERD you can find in databaseInfo folder in the project

## for testing simply run this command
*** php artisan test ***
### FYI this command is reseting whole database information amd adding default ones, also is runing some unit tests
