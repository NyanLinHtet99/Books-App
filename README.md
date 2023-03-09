## About This Project

This is a sample laravel project built simply to test my skills and still not completed yet.
Currently this app uses

-   CSS/HTML/Bootstrap 5
-   Javascript(jQuery)/Jqwidgets UI library for frontend
-   PHP/Laravel for backend
-   Laravel ui for authentication

## Features

This app mimics a webnovel reading site and plans to add more features accordingly.
For now this has a profile window where user can upload their profile picture,
commenting on books and giving stars rating.
A book may has many tags which uses the laravel many to many relation.

For javascript part, this uses a dynamically created books grids which uses ajax
for showing the next page or filtering the result without reloading the page.
Clicking the book will show the user a book window which is also created dynamically where one can go to the book's show page.

As of this moment the page is rather unstlyed and every books uses the same default picture.

## For checking out the project

This repos also includes the storage/public folder inside which has the js files and default images.
I have also written the seeder file even thou it's a bit messy.
After cloning and setting up the database you can just run migrate with seed to check this out.
