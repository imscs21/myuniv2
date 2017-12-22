How to setup
==========
1. install laravel 5.4 on your computer  
    * installation guide here: http://l5.appkr.kr/lessons/02-hello-laravel.html
2. add 'composer' and 'php' command to your system variable environment to recognize it on your command line.
3. run clean.bat.
4. open '.env' file and modify value of DB_PORT property for your db connection.
5. And then open ./config/database.php  file and modify port number at line contains 'port' => env('DB_PORT', ... in mysql config category for your db connection.
6. run clean.bat again
7. execute initdb.sql which contains queries  to create additional mysql user and inittable.sql file in your mysql for our database environment.
8. move project directory to top directory of your server's document directory such as htdocs folder.
9. change http port to 8888
10. execute (link.bat or link.sh or link_comp.sh) as admin to obtain permission of administrator account
11. open browser and visit http://127.0.0.1:8888/webproj
11.  We don`t recommend url is http://localhost:8888 because of github oauth callback link which is static or manual link


## Our Project
    > You can see our project at https://github.com/HYUeWebAppPROj

### OpenSource
* responsiveslides.js - MIT license
* jquery - MIT license
* AngularJS - MIT license
* Laravel - MIT license
* material-icons - Apache 2.0