# zoo-database
A relational database for managing a zoo 

# Installing Requirements
In genreral install php 7.1 and mysql (note you may have to install the mysql extension depending on wheather or not it comes bundled with php)

make sure mysql is started

## Windows
One can use  [bash on ubuntu on windows](https://msdn.microsoft.com/en-us/commandline/wsl/about)

the folowing commands will install php7.1 and mysql etc

`sudo add-apt-repository ppa:ondrej/php`

`sudo apt update`

`sudo apt full-upgrade`

`sudo apt install php7.1 mysql-server-5.6 php7.1-mysql`

## OSX
I don't own one so some one else will have to figure this out. Prusmably one could install php through one of the various package managers for osx. 

## Linux
either istall php and mysql (note recent distros uses  MariaDB  instead of mysql  MariaDB  will work fine.)

or install docker and docker compose

### ALL EXCEPT DOCKER USERS
crete a schema to store the tables in

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

run `sudo sh d-run`
or 

## Setup website

go to [http://127.0.0.1:8080/setupform.php](http://127.0.0.1:8080/setupform.php)

for the following fields fill put in the following

Database host:127.0.0.1

User name:your mysql user name

Password:your mysql password

Database name: the name of the schema you created

fName: first name of employee

lname: last name of employee

id: for employee

username: foremployee

Password: for employee

sex: for employee

ssn: for employee

email: for employee

the employee created heare will be a superUser

## reseting on other platforms

delete `src/settings/files/db.json`
run `drop schema somedbname`

 ## reseting on Docker
run `sudo sh d-reset`