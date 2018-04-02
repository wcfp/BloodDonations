Team lead: Andrei Gavrila

Sergiu Roman

Sabadas Oana

Lorena Sabou

George Sava


How to setup:
 - install XAMPP
 - install composer
 - install npm
 - install PhpStorm
 - in PhpStorm, import project from version control and paste the git url there
 - run composer install in the terminal
 - run npm install in the terminal
 - start xampp
 - start apache and mysql
 - click admin on mysql
 - create new database blooddonation
 - create new user blooddonation_root with the same password
 - select all checkboxes
 - open .env file in php storm
 - make sure those fields are as follows:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=blooddonations
    DB_USERNAME=blooddonations_root
    DB_PASSWORD=blooddonations_root
 - run php artisan migrate in the terminal
 - run php artisan db:seed
 - run composer install again
 - to be continued
 
 
How to contribute:
 - Pick a task from YouTrack
 - Make sure you're on the latest master before you start a task otherwise there will be conflicts
 - Create a branch called "[your nickname/task number]" (e.g. andrei/BDMS-11)
 - Commit and push all your changes here
 - Fix merge conflicts with the latest master
 - Try to have tests for the backend stuff
 - Go to github, create a pull request for your branch
 - Wait for it to get accepted