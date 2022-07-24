# Setting up Test application

## Introduction
In this document, you will find instruction on how to set up Test app.

## Getting Started
Before setting up test, you will need to:
Have a working environment set up capable of hosting and serving PHP web applications.

At a minimum you have to have the following tools set up and working:
1. PHP
2. MySQL
3. Web server

Since app is built using laravel version 9, environment should also have all laravel requirements up and working according to
laravel specifications.

## Dependencies
In order to install app and its dependencies, you will need the following tools:
1. git
2. composer

## Instructions
Once you've collected your dependencies, to install test app you will need to :
1. Clone test app repo - https://github.com/kottman/will-app-test
2. Copy `.env.example` to `.env`
3. Update `.env` with required info
4. Run `composer install`
5. Run `migrations`

### Test app specific environment (`.env`) variables:
```
ADMIN_EMAIL= # a valid google email that will be used as admin, example somegoogle@gmail.com
ADMIN_DOMAIN= # Users with this domain in this email will be considered as admins, example: cloudasta.com
ADMIN_NAME_PART= # Users with this string in their name will be considered as admins, example: QA
GOOGLE_CLIENT_ID= # The google client id for OAuth, provided by google, set that app in google console
GOOGLE_CLIENT_SECRET=# The google client secret for OAuth, provided by google, set that app in google console
GOOGLE_REDIRECT=# The redirect URL, have to set that app in google console
```

### Setting up the admin
For setting up the admin you will need to:
1. Have a valid google email that you have access to
2. Set `.env` `ADMIN_EMAIL` to your google email
3. Log in to the app using that email 
