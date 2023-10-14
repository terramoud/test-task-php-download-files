# test-task-php

How to run project?

1) Open PhpStorm
2) Click to File->Project from version control
3) URL: put https://github.com/terramoud/test-task-php.git
4) Directory: choose what you want
5) Click to 'clone' button and wait until loaded project
6) Open a terminal and make sure you stay in the root of the project
7) Execute `composer init` and press enter all times to set all default settings
8) Execute `composer dump-autoload`  
9) Execute `php -S localhost:8080 -t public`
10) Open http://localhost:8080

Routing:
* '/' -> registration page
* '/register' -> registration page
* '/list-users' -> table of all users
