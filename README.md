TurlockCityBooze
================

This is a website I built in the last semester at CSU Stanislaus in Turlock to find the happy hours currently happening in town. After graduating and moving out of the area it didn't seem right to run a website for a community I am no longer part of. 

In it's short life (about 6 months) the website was able to recover the cost of running it. I have since started taking what I built for internal use and started building it as a consumer CMS. This is just the code I used to run it. It was built in just a few short weeks between classes. 


### Requirements
- Linux Server
- PHP
- MySQL
- Composer


### Installation

To setup TCB to run on your own web server you will need to follow the steps below:

1) `cd turlockcitybooze` or the directory you have downloaded the code base to
2) `php composer.phar update` to download all the required components to run the application
3) Set the following environment variables:
    - "db_user" to the username of the MySQL user
    - "db_pass" to the password of the MySQL user
4) Create a database names "turlockcitybooze"
5) `php artisan migrate` to install the database
6) Go to your application's server and log into the admin at example.com/manage with the following credentials:
    - email: admin@turlockcitybooze.com
    - password: Mj)gV2^d6mfD%3FuVsG7
7) Change your password and email
