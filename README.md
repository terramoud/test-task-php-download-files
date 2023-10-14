# test-task-php-download-files

How to run project?

1) Install XAMPP
2) Open PhpStorm
3) Click to File->Project from version control
4) URL: put https://github.com/terramoud/test-task-php-download-files.git
5) Directory: choose `pathToYourXAMPP/xampp/htdocs/test-task-php-download-files`
6) Click to 'clone' button and wait until loaded project
7) Open a terminal and make sure you stay in the root of the project
8) Execute `composer init` and press enter all times to set all default settings
9) Execute `composer dump-autoload`
10) Configure the web server to run test task
    * At first need to create virtual host
        * Open file: pathToYourXAMPP/xampp/apache/conf/extra/httpd-vhosts.conf
        * Add new virtual host:   
      `<VirtualHost *:80>`  
      `DocumentRoot "pathToYourXAMPP/xampp/htdocs/test-task-php-download-files/public"`  
      `ServerName test-task-php-download-files`  
      `</VirtualHost>`
    * And add `127.0.0.1 test-task-php-download-files` to hosts file
11) Open XAMPP and run Apache server and MySQL server
12) Open The MySQL Command-Line Client and create new database and fill with demo data
    * Do authorization at the MySQL Command-Line Client
    * Run `mysql> CREATE DATABASE php_test_task_files;`command to create a new database
    * Run `mysql> SHOW DATABASES;` command to ensure that a new database is created
    * Run `mysql> USE php_test_task_files;` command to use our database
    * Run `mysql> source pathToYourXAMPP/xampp/htdocs/test-task-php-download-files/demo-db.sql` to create demo data to run project
13) Open `test-task-php-download-files` project in the code editor 
14) Open `test-task-php-download-files/src/MySQLConfig.php` config class 
15) In the `MySQLConfig.php` write your datasource, username and password.
16) Open http://test-task-php-download-files/login
17) Open in text editor `pathToYourXAMPP/xampp/htdocs/test-task-php-download-files/demo-db.sql` to get user's email and password
18) Enter the received e-mail and password in the login form
19) After redirecting to `/home` page, select files 

Routing:
* `/` -> login page
* `/login` -> login page
* `/home` -> home page
* `/send-data` -> using by ajax to send files from form
* `/handle-upload` -> using by cURL to save files from form
