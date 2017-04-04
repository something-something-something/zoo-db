# zoo-database
A relational database for managing a zoo 

# Installing Requirements
In genreral install php 7.1 and mysql (note you may have to install the mysql php extension depending on wheather or not it comes bundled with php)

make sure mysql is started

## Windows
One can use  [bash on ubuntu on windows](https://msdn.microsoft.com/en-us/commandline/wsl/about)

the folowing commands will install php7.1 and mysql etc

`sudo add-apt-repository ppa:ondrej/php`

`sudo apt update`

`sudo apt full-upgrade`

`sudo apt install php7.1 mysql-server-5.6 php7.1-mysql`

## OSX
I don't own one so some one else will have to figure this out. Presumably one could install php through one of the various package managers for osx. 

## Linux
either install php and mysql (note recent distros uses  MariaDB  instead of mysql  MariaDB  will work fine.)

or install docker and docker compose

### ALL EXCEPT DOCKER USERS
create a schema to store the tables in

`mysql -u root -p`

`create schema somedbname;`

`\q`

# Running
basicly run

`php -S 127.0.0.1:8080 -t src`

in this directory if you are using bash just run 

`. run`

instead



## Bash on Ubuntu on Windows
start the mysql server

`sudo service mysql start`

run 

`. run`

## On docker on Linux

run `sudo sh d-run` or `docker-compose up --build` (might need to prefix with `sudo` )

## Setup website

go to [http://127.0.0.1:8080/setupform.php](http://127.0.0.1:8080/setupform.php)

for the following fields fill put in the following

Database host:127.0.0.1 (unless you are using docker in which case it is `db` )

User name:your mysql user name (for docker `g20` )

Password:your mysql password (for docker `p` )

Database name: the name of the schema you created (for docker `adb` )

fName: first name of employee

lname: last name of employee

id: for employee

username: foremployee

Password: for employee

sex: for employee

ssn: for employee

email: for employee

address: for employee

dob: for employee

click submit This will create the tables and an employee as specified by the form. 

the employee created here will be a superUser

## reseting on other platforms

delete `src/settings/files/db.json`
run `drop schema somedbname` in mysql

## accessing sql on docker (for debuging)

run `sudo sh d-enterdb` or `docker-compose exec db mysql -u g20 -pp adb`

 ## reseting on Docker
run `sudo sh d-reset` or `docker-compose rm -vf` (might need to prefix with `sudo` )